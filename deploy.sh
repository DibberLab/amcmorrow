#!/bin/bash
# 1. Restore the source index.html just in case
echo '<!doctype html><html lang="en"><head><meta charset="UTF-8" /><link rel="icon" type="image/svg+xml" href="/vite.svg" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Portfolio</title></head><body><div id="root"></div><script type="module" src="/src/main.tsx"></script></body></html>' > index.html

# 2. Build the project
npm run build

# 3. Clean and Move
rm -rf assets
cp -r dist/* .
