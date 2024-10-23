#!/bin/bash

echo "Cleanning public/{js|css}"
echo "Clean public/js"
for js_chunks in $(find ./public/js -type f \( -regex ".*\/(events|app|cms).js" -or -regex ".*\/[0-9]*.js" -or -regex ".*\/[0-9a-z]*.js.map" -or -regex ".*.txt" -or -regex ".*\/resources_js.*.js" -or -regex ".*\/resources_js.*.js.map" \) -print); do
  echo ${js_chunks}
  rm -f ${js_chunks}
done

for js_chunks in $(find ./public -type f \( -regex ".*\/(events|app|cms).js" -or -regex ".*\/[0-9]*.js" -or -regex ".*\/[0-9a-z]*.js.map" -or -regex ".*.txt" -or -regex ".*\/resources_js.*.js" -or -regex ".*\/resources_js.*.js.map" \) -print); do
  echo ${js_chunks}
  rm -f ${js_chunks}
done


rm -f public/js/events.js &2> /dev/null
rm -f public/js/app.js &2> /dev/null
rm -f public/js/cms.js &2> /dev/null
rm -f public/js/demo.js &2> /dev/null
rm -f public/mix-manifest.json  &2> /dev/null

echo "Clean public/css"
for css_chunks in $(find ./public/css -type f \( ! -name "normalize.css" -and \( -regex ".*\/.*.css" -or -regex ".*\/.*.css.map" \) \) -print); do
  echo ${css_chunks}
  rm -f ${css_chunks}
done

rm -Rf public/vendors~


