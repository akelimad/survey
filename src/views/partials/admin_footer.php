<footer id="footer">
    <div class="container">
        <nav class="navbar navbar-default" id="footer-navbar">
            <div class="container-fluid pl-5 pl-xs-15">
                <ul class="nav navbar-nav">
                    <li><a href="<?= site_url('terms'); ?>"><?php trans_e("Mentions légales"); ?></a></li>
                    <li><a href="<?= site_url('conditions'); ?>"><?php trans_e("Conditions Générales d'utilisation"); ?></a></li>
                    <li><a href="<?= site_url('sitemap'); ?>"><?php trans_e("Plan du site"); ?></a></li>
                    <?php if(get_setting('allow_bugs_report') == 1) : ?>
                    <li><a href="<?= site_url('bug-report'); ?>"><?php trans_e("Signaler un problème"); ?></a></li>
                    <?php endif; ?>
                </ul>
                <?php if(get_setting('show_copyright') == 1) : ?>
                <ul class="nav navbar-nav navbar-right pr-5 mt-xs-0">
                    <li><a href="http://www.etalent.ma/" target="_blank" title="<?php trans_e("E-Talent- Nouvelle fenêtre"); ?>">&copy; E-Talent</a></li>
                </ul>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</footer>