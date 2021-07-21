<style type="text/css">
	.cssload-thecube {width: 73px;height: 73px;margin: 50px 0;position: relative;transform: rotateZ(45deg);}
.cssload-thecube .cssload-cube {position: relative;transform: rotateZ(45deg);}
.cssload-thecube .cssload-cube {float: left;width: 50%;height: 50%;position: relative;transform: scale(1.1);}
.cssload-thecube .cssload-cube:before {content: "";position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-color: #000F9F;animation: cssload-fold-thecube 2.76s infinite linear both;transform-origin: 100% 100%;}
.cssload-thecube .cssload-c2 {transform: scale(1.1) rotateZ(90deg);}
.cssload-thecube .cssload-c3 {transform: scale(1.1) rotateZ(180deg);}
.cssload-thecube .cssload-c4 {transform: scale(1.1) rotateZ(270deg);}
.cssload-thecube .cssload-c2:before {animation-delay: 0.35s;}
.cssload-thecube .cssload-c3:before {animation-delay: 0.69s;}
.cssload-thecube .cssload-c4:before {animation-delay: 1.04s;}
@keyframes cssload-fold-thecube {
	0%, 10% {transform: perspective(136px) rotateX(-180deg);opacity: 0;}
	25%,75% {transform: perspective(136px) rotateX(0deg);opacity: 1;}
	90%,100% {transform: perspective(136px) rotateY(180deg);opacity: 0;}
}
#loadingmsg {color: black;padding: 10px;position: fixed;top: 35%;left: 50%;z-index: 99999999;margin-right: -25%;margin-bottom: -25%;}
#loadingover {background: black;z-index: 999999;width: 100%;height: 100%;position: fixed;top: 0;left: 0;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";filter: alpha(opacity=80);-moz-opacity: 0.4;-khtml-opacity: 0.4;opacity: 0.4;}

/*alert box css*/
#oepl_newalert, #html_main_div {width: 100%;height: 100%;opacity: 1;top: 0;left: 0;display: none;position: fixed;background-color: rgba(49, 49, 49, 0.83);overflow: auto;z-index: 9999999;}
img#close {position: absolute;right: -14px;top: -14px;cursor: pointer}
div #oepl_newalertpop, div #html_content_pop_main {position: absolute;left: 50%;top: 20%;margin-left: -225px;font-family: 'Raleway', sans-serif;width:100%;max-width: 470px;background: #fff;opacity: 1;padding: 20px;}
.alert_content {min-width: 250px;padding: 10px;border: 2px solid gray;border-radius: 10px;background-color: #fff;width: 350px;}
.alert_content p {margin-top: 15px;font-size: 14px;text-align: center;}
.alert_content h2 {background-color: transparent;padding: 10px;text-align: center;border-radius: 10px 10px 0 0}
.alert_content hr {border: 0;border-top: 1px solid #ccc;margin: 10px !important;}
ul.tagit input[type="text"]{width: 100% !important;height: 100% !important;}
ul.tagit li.tagit-new {padding: 0 !important;}
#html_main_div {z-index: 99999;}
</style>
<div id="loadingmsg" style="display: none;">
	<div class="cssload-thecube">
		<div class="cssload-cube cssload-c1"></div>
		<div class="cssload-cube cssload-c2"></div>
		<div class="cssload-cube cssload-c4"></div>
		<div class="cssload-cube cssload-c3"></div>
	</div>
</div>
<div id="loadingover" style="display: none;"></div>