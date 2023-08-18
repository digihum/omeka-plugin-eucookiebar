<?php if ($this->analytics): ?>
	<?php $this->headScript()->captureStart(null,"text/plain",array("data-cookiecategory"=>"analytics")); ?>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', <?php echo js_escape($this->analytics) ?>, 'auto');
			ga('send', 'pageview');
	<?php $this->headScript()->captureEnd() ?>
<?php endif; ?>