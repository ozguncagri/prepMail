# prepMail

Style inliner for preparing e-mail ready html templates on your CLI. `prepMail.phar` file may require php runtime on your computer.

You can easly customize build process of `prepMail.phar` with editing `builder.php` file or you can download prebuilt file on releases section and build folder of repo.

## Sample Usage

```
prepMail <input-html-file> <input-css-file> <output-html-file>
```

## Example

**File :** `test.html`

```html
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="testing">Hello World!</div>
</body>
</html>
```

**File :** `style.css`

```css
body {
	background: teal;
}

.testing {
	background: tomato;
	color: lime;
}
```

Merging two files with **prepMail** command;

```sh
prepMail test.html style.css out.html
```

**Output file :** `out.html`

```html
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="utf-8">
	
</head>
<body style="background: teal;">
	<div style="background: tomato; color: lime;">Hello World!</div>
</body>
</html>
```
