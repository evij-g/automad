<# 

This template extends the "post.php" template.
The "main" snippet is overriden to actually change the content of the page body.

Note that the order of the block editor fields can be defined by simply adding the
in those variables in the correct order to a comment block in the header of a template as follows:

@{ +hero }
@{ +main }

#>
<@ snippet main @>
	<div class="uk-flex">
		<main class="uk-width-large-3-4">
			<div class="content uk-block sidebar-block">
				<@ elements/content.php @>
				<@ elements/related_simple.php @>
			</div>
		</main>
		<@ elements/sidebar.php @>
	</div>
<@ end @>
<@ post.php @>