<?php

class APPS
{
	public function APPS()
	{
		
	}
	public function include_js($classname, $jsname)
	{
		print ('<script src = "pages/apps/sources/');
		print ($classname);
		print ('/');
		print ($jsname);
		print ('.js"></script>');
	}
	public function script($script)
	{
		print("<script>".$script."</script>");
	}
}

?>