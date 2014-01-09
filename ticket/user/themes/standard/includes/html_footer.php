<?php 
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

?>
					<div class="clear"></div>
					<br />
					<div id="footer">
						<div id="footer-design">
							<div id="copyright"><?php echo safe_output($language->get('Copyright')); ?> &copy; <a href="http://www.oceantailer.ncom/">Oceantailer</a> <?php echo date('Y'); ?></div>
							<div id="version"><?php //echo stop_timer(); ?></div>
							<div class="clear"></div>
						</div>
					</div>	
					
				</div>


			</div>
		</div>
	</div>
</body>
</html>