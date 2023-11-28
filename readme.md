## Description

This repo is a showcase of a bug that we found in Gutenberg's php rendering.
When a block is rendered with an HTML attribute that contains a greater-than-sign (`>`) the block is not rendered correctly. Special characters after the greater-than-sign are escaped. This causes the string closing character (`"`) to be escaped and the following attributes to become part of the string.

### Code example:

**PHP rendering of the block:**

*[Image version of the code](./images/code-example.png)*

```html
<!-- Wrapped in sections to make sure browsers can fix the DOM -->

<section>
	<p>Example 1: Tailwind class name</p>
	<div class="[&>*]:bg-gray-300">
		<p>Demo Text</p> 
	</div>
	<!-- this is part of the classes -->
	<div class="is-now-an-attribute">

	</div>
</section>

<section>
	<p>Example 2: Other attribute with only greater than sign</p>
	<div data-demo-attribute=">">
		<p>Demo Text</p>
	</div>
	<!-- this is part of the demo attribute -->
	<div class="is-now-an-attribute">
	
	</div>
</section>
```

**Send HTML:**

*[Image version of the HTML](./images/recieved-html.png)*

```html
<!-- Wrapped in sections to make sure browsers can fix the DOM -->

<section>
	<p>Example 1: Tailwind class name</p>
	<div class="[&#038;>*]:bg-gray-300&#8243;>
		<p>Demo Text</p> 
	</div>
	<!-- this is part of the classes -->
	<div class="is-now-an-attribute">

	</div>
</section>

<section>
	<p>Example 2: Other attribute with only greater than sign</p>
	<div data-demo-attribute=">&#8220;>
		<p>Demo Text</p>
	</div>
	<!-- this is part of the demo attribute -->
	<div class="is-now-an-attribute">
	
	</div>
</section>
```

**Parsed HTML (Chrome):**

*[Image version of the parsed HTML](./images/parsed-html.png)*

```html
<!-- Wrapped in sections to make sure browsers can fix the DOM -->

<section>
	<p>Example 1: Tailwind class name</p>
	<div class="[&amp;>*]:bg-gray-300″>
		<p>Demo Text</p> 
	</div>
	<!-- this is part of the classes -->
	<div class=" is-now-an-attribute"="">

	</div>
</section>

<section>
	<p>Example 2: Other attribute with only greater than sign</p>
	<div data-demo-attribute=">“>
		<p>Demo Text</p>
	</div>
	<!-- this is part of the demo attribute -->
	<div class=" is-now-an-attribute"="">
	
	</div>
</section>
```


## How to view the bug

You can either clone this repo and compile it or upload the already compiled and packed version [plugin-block.zip](./plugin/plugin-block/plugin-block.zip) to your WordPress installation.
Trying to add a greater-than-sign to the attribute of one of your blocks should of course also work, if you are rendering the block with php.

After activating the plugin you can add the block "Demo Block" to a post or page and view the bug in the frontend. The block has two examples of the bug. One with a tailwind class name and one with a custom attribute.

### Building the plugin

- To build the plugin you need to have npm and composer installed.
- After cloning the repo run `npm install` and `composer install` to install all dependencies.
- Then run `npm run build` to build the plugin and `npm run plugin-zip` to pack it into a zip file.
