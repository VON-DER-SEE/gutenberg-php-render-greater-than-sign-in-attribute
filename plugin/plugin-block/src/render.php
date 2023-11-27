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
