/**
 * Minifies inline <script> blocks in all PHP files using Terser.
 * Skips <script type="application/ld+json"> blocks.
 * Modifies files in place — commit to git first if you want a rollback point.
 *
 * Usage: npm run minify-js
 */

const { minify } = require('terser');
const fs = require('fs');
const path = require('path');

const ROOT = __dirname;

/** Recursively collect all .php files, skipping node_modules */
function findPhpFiles(dir, result = []) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        if (entry.name === 'node_modules') continue;
        const full = path.join(dir, entry.name);
        if (entry.isDirectory()) findPhpFiles(full, result);
        else if (entry.name.endsWith('.php')) result.push(full);
    }
    return result;
}

/** Minify all eligible <script> blocks in a single file */
async function processFile(filePath) {
    const src = fs.readFileSync(filePath, 'utf8');

    // Match <script ...>...</script> blocks
    const re = /(<script(?:\s[^>]*)?>)([\s\S]*?)(<\/script>)/gi;
    const matches = [];
    let m;

    while ((m = re.exec(src)) !== null) {
        const [full, open, js, close] = m;
        // Skip JSON-LD and empty/whitespace-only blocks
        if (/type\s*=\s*["']application\/ld\+json["']/i.test(open)) continue;
        if (!js.trim()) continue;
        matches.push({ full, open, js, close, index: m.index });
    }

    if (matches.length === 0) return false;

    let output = src;
    let offset = 0;
    let changed = false;

    for (const block of matches) {
        try {
            const result = await minify(block.js, {
                compress: { drop_console: false },
                mangle: true,
                format: { comments: false }
            });

            if (result.code) {
                const replacement = block.open + result.code + block.close;
                const pos = block.index + offset;
                output = output.slice(0, pos) + replacement + output.slice(pos + block.full.length);
                offset += replacement.length - block.full.length;
                changed = true;
            }
        } catch (err) {
            console.warn(`  [SKIP] Could not minify block in ${path.relative(ROOT, filePath)}: ${err.message}`);
        }
    }

    if (changed) {
        fs.writeFileSync(filePath, output, 'utf8');
    }

    return changed;
}

async function main() {
    const files = findPhpFiles(ROOT);
    console.log(`Found ${files.length} PHP file(s).\n`);

    let count = 0;
    for (const f of files) {
        const changed = await processFile(f);
        if (changed) {
            console.log(`  Minified: ${path.relative(ROOT, f)}`);
            count++;
        }
    }

    console.log(`\nDone. ${count} file(s) updated.`);
}

main().catch(err => {
    console.error(err);
    process.exit(1);
});
