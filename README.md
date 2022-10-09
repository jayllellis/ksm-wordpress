# King Street Media (React + Headless Wordpress)

From the root of the project, you can:
```
yarn start
```

OR

```
npm start
```

## Sources

https://reactjs.org/docs/create-a-new-react-app.html  
https://tailwindcss.com/docs/guides/create-react-app

## Production Build

From the root of the project, you can:
```
yarn build
```

OR

```
npm run build
```

### Database and Uploads folder
These will require manual deployment via phpMyAdmin (database) and FTP (uploads).  
_Unless you have an automated WordPress service such as WP Engine, Pantheon, etc._

## Folder Structure After Build

```
index.html
asset-manifest.json
manifest.json
robots.txt
.htaccess
api/ (WordPress installation)
static/
  css/
  js/
  media/
```

## Environment variables

_*All URLs are without the trailing slash_

### React
__REACT_APP_PUBLIC_URL__: The main site/home URL (dev or production)  
__REACT_APP_API_URL__: The WordPress main REST API URL (i.e. `<home_url>/api/wp-json/v1`)  

### WordPress
__APP_ENV__: The app environment  
__DB_NAME__: WordPress database name  
__DB_USER__: WordPress database user name  
__DB_PASSWORD__: WordPress database password  
__DB_HOST__: WordPress database host (usually `localhost`)  
__WP_REACT_URL__: The main site/home URL (dev or production)  

## Photos
All photos are retrieved from the backend using the [wp_get_attachment_image_src](https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/) function  

They always return an array like this:
```php
[
    "https://ksm.lndo.site/api/wp-content/uploads/....jpg", // [0] = image url
    1440, // [1] = image width in pixels
    849, // [2] = image height in pixels
    false // [3] = whether the image is a resized image
]
```

### Except, project images have an extra value:
```php
[
    "https://ksm.lndo.site/api/wp-content/uploads/....jpg", // [0] = image url
    1440, // [1] = image width in pixels
    849, // [2] = image height in pixels
    false, // [3] = whether the image is a resized image
    "Photo by Peter Parker" // [4] = image caption
]
```
