<!DOCTYPE html>
<html lang="ja-JP">
  <head>
    <title>Reddit Checker</title>
    <meta charset="utf-8">
    <meta name="keyword" content="reddit,checker,newsokur,レディット,チェッカー,ニュー速R">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
    <form action="user" method="get">
      <div class="input-field col s6">
        <input id="username" name="username" type="text" class="validate" autocomplete="off">
        <label for="username">user name</label>
        <button id="check" class="btn waves-effect waves-light" type="submit" name="action">CHECK
        <i class="mdi-navigation-check right"></i>
        </button>
      </div>
    </form>
      <div id="text">
      <h1 class="title"><span>Reddit Checker</span></h1>
      <p class="desc">It graphically displays user information of reddit.<br>
       It is using laravel, materialize, and chartistjs.<br>
       created by <a href="http://twitter.com/IDkaetazo/" target="_blank">@IDkaetazo</a></p>
       </div>
    </div>

    <section class="naname">
      <span></span>
    </section>
   
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script>
  $(document).ready(function(){
  var agent = navigator.userAgent;
  if(agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1){
    if($(window).height()<500){
	  	$('form').css('padding-top','1%');
	}
   }
  });
  $("#username").click(function(){
  var wH = $(window).height();
  var agent = navigator.userAgent;
  if(agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1){
    $('html,body').css('height',wH+'px');
    }
  });
  $("#username").blur(function(){
	if(agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1){
    $('html,body').css('height','100%');
    }
  });
  </script>
  </body>
</html>
