

# Counter Speech Front End

### Setup

All source files are in the Src folder. This folder contains files to build the inline javascript, the app javascript, the base css and the app css (and noscript css)
```
src
```

Public stores assets needed on Distribution and Debug, as well as devlopment instances of JS/CSS files.
```
public
```

Dist is the final distributed files if minified.
```
dist
```


### Develop
Running `npm run dev` will watch changes on both the inline script and the main app.
All webpack calls are managed and configured using the `config/webpack.js` script. This will load in the proper configuration and determine to watch or just build the package files.

### Deploy
Running `npm run deploy` will build minified files for both the inline script and the main app. The main app will get hashed so that whenever there is an update the new file name will bust the cache. Hashing is stored in the `asset-manifest.json` file which is then loaded into the wordpress .php theme header file.

### Map data
We use D3, and retreived map data using:
a correct map that has the disputed borders highlighted in India, Pakistan, and Kashmir and Jammu
http://mapstarter.com/

https://geojson-maps.ash.ms/ simple short cut way to generate map files.
http://mapshaper.org/ Optimzes map geojson files.
