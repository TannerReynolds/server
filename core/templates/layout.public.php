<!DOCTYPE html>
<html class="ng-csp" data-placeholder-focus="false" lang="<?php p($_['language']); ?>" data-locale="<?php p($_['locale']); ?>" >
<head data-requesttoken="<?php p($_['requesttoken']); ?>">
	<meta charset="utf-8">
	<title>
		<?php
		p(!empty($_['application'])?$_['application'].' - ':'');
		p($theme->getTitle());
		?>
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<?php if ($theme->getiTunesAppId() !== '') { ?>
	<meta name="apple-itunes-app" content="app-id=<?php p($theme->getiTunesAppId()); ?>">
	<?php } ?>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="<?php p((!empty($_['application']) && $_['appid'] !== 'files')? $_['application']:$theme->getTitle()); ?>">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="theme-color" content="<?php p($theme->getColorPrimary()); ?>">
	<link rel="icon" href="<?php print_unescaped(image_path($_['appid'], 'favicon.ico')); /* IE11+ supports png */ ?>">
	<link rel="apple-touch-icon" href="<?php print_unescaped(image_path($_['appid'], 'favicon-touch.png')); ?>">
	<link rel="apple-touch-icon-precomposed" href="<?php print_unescaped(image_path($_['appid'], 'favicon-touch.png')); ?>">
	<link rel="mask-icon" sizes="any" href="<?php print_unescaped(image_path($_['appid'], 'favicon-mask.svg')); ?>" color="<?php p($theme->getColorPrimary()); ?>">
	<link rel="manifest" href="<?php print_unescaped(image_path($_['appid'], 'manifest.json')); ?>">
	<?php emit_css_loading_tags($_); ?>
	<?php emit_script_loading_tags($_); ?>
	<?php print_unescaped($_['headers']); ?>
</head>
<body id="<?php p($_['bodyid']);?>">
	<!-- TITLE BAR -->
    <div class="ui-titlebar">
        <!--<div class="ui-titleicon"></div>-->
        <div class="ui-titletext">Golden Bay Fence Cloud</div>
        <div class="ui-titlecontrols">
            <button class="ui-btn minimize">
                <svg x="0px" y="0px" viewBox="0 0 10.2 1"><rect x="0" y="50%" width="10.2" height="1" /></svg>
            </button><button class="ui-btn maximize">
                <svg viewBox="0 0 10 10"><path d="M0,0v10h10V0H0z M9,9H1V1h8V9z" /></svg>
            </button><button class="ui-btn close">
                <svg viewBox="0 0 10 10"><polygon points="10.2,0.7 9.5,0 5.1,4.4 0.7,0 0,0.7 4.4,5.1 0,9.5 0.7,10.2 5.1,5.8 9.5,10.2 10.2,9.5 5.8,5.1" /></svg>
            </button>
        </div>
    </div>
    <!-- END TITLE BAR -->
<?php include('layout.noscript.warning.php'); ?>
<?php foreach ($_['initialStates'] as $app => $initialState) { ?>
	<input type="hidden" id="initial-state-<?php p($app); ?>" value="<?php p(base64_encode($initialState)); ?>">
<?php }?>
	<div id="notification-container">
		<div id="notification"></div>
	</div>
	<header id="header">
		<div class="header-left">
			<span id="nextcloud">
				<div class="logo logo-icon svg"></div>
				<h1 class="header-appname">
					<?php if (isset($template) && $template->getHeaderTitle() !== '') { ?>
						<?php p($template->getHeaderTitle()); ?>
					<?php } else { ?>
						<?php	p($theme->getName()); ?>
					<?php } ?>
				</h1>
				<?php if (isset($template) && $template->getHeaderDetails() !== '') { ?>
				<div class="header-shared-by">
					<?php p($template->getHeaderDetails()); ?>
				</div>
				<?php } ?>
			</span>
		</div>

		<?php
		/** @var \OCP\AppFramework\Http\Template\PublicTemplateResponse $template */
		if (isset($template) && $template->getActionCount() !== 0) {
			$primary = $template->getPrimaryAction();
			$others = $template->getOtherActions(); ?>
		<div class="header-right">
			<span id="header-primary-action" class="<?php if ($template->getActionCount() === 1) {
				p($primary->getIcon());
			} ?>">
				<a href="<?php p($primary->getLink()); ?>" class="primary button">
					<span><?php p($primary->getLabel()) ?></span>
				</a>
			</span>
			<?php if ($template->getActionCount() > 1) { ?>
			<div id="header-secondary-action">
				<button id="header-actions-toggle" class="menutoggle icon-more-white"></button>
				<div id="header-actions-menu" class="popovermenu menu">
					<ul>
						<?php
							/** @var \OCP\AppFramework\Http\Template\IMenuAction $action */
							foreach ($others as $action) {
								print_unescaped($action->render());
							}
						?>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
		} ?>
	</header>
	<div id="content" class="app-<?php p($_['appid']) ?>" role="main">
		<?php print_unescaped($_['content']); ?>
	</div>
	<?php if (isset($template) && $template->getFooterVisible()) { ?>
	<footer>
		<p><?php print_unescaped($theme->getLongFooter()); ?></p>
		<?php
		if ($_['showSimpleSignUpLink']) {
			?>
			<p>
				<a href="https://nextcloud.com/signup/" target="_blank" rel="noreferrer noopener">
					<?php p($l->t('Get your own free account')); ?>
				</a>
			</p>
			<?php
		}
		?>
	</footer>
	<?php } ?>

</body>
</html>
