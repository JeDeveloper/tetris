		<?php //include_once "simphp.php";?>
		<div id="otherStuffBar" class="panel panel-default">
			<!--<button type="button" onclick="toggleFacts()">Show/Hide Facts</button>-->
			<form action="searchresults.php" method="get" id="search" style="padding:4px 4px 4px 4px;">
				<input type="text" name="query" style="float:left; width:85%"/>
				<a href="javascript:{}" class="btn btn-info btn-lg" onclick="document.getElementById('search').submit();" style="font-size:14; padding: 4px 4px 4px 4px; float:right;">
					<span class="glyphicon glyphicon-search"></span>
				</a>
			</form>
			<hr/>
			<div>
				<a class="twitter-timeline" href="https://twitter.com/Rockettopia" data-widget-id="329286351667208193">Tweets by @Rockettopia</a>
				<script>
					!function(d,s,id)
					{
						var js,fjs = d.getElementsByTagName(s)[0],p = /^http:/.test(d.location)?'http':'https';
						if(!d.getElementById(id))
						{
							js = d.createElement(s);
							js.id=id;
							js.src=p+"://platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js,fjs);
						}
					}
					(document,"script","twitter-wjs");
				</script>
			</div>
		</div>