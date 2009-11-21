<?PHP

include "../index.php";

$shell['title3'] = "Debouncing";

$shell['h2'] = 'Don\'t fire that event any more than you have to!';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
var default_text = $('#text-type').text();

$('form input').keyup(function(){
  $(this).doTimeout( 'text-type', 250, function(){
    $('#text-type').text( this.val() || default_text );
  });
});
<?
$shell['script1'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
// Debounced window.onresize

var resize = 0,
  dt_resize = 0;

$(window).resize(function(){
  resize++;
  
  $('#text-resize-1').html( 'window.onresize event fired: ' + resize + ' times<br/>window dimensions: ' + $(window).width() + 'x' + $(window).height() );
  
  $.doTimeout( 'resize', 250, function(){
    dt_resize++;
    
    $('#text-resize-2').html( 'doTimeout, 250ms delay, fired: ' + dt_resize + ' times<br/>window dimensions: ' + $(window).width() + 'x' + $(window).height() );
  });
});

$(window).resize();

<?
$shell['script2'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
// Debounced window.onscroll

var scroll = 0,
  dt_scroll = 0;

$(window).scroll(function(){
  scroll++;
  
  $('#text-scroll-1').html( 'window.onscroll event fired: ' + scroll + ' times<br/>window scrollLeft: ' + $(window).scrollLeft() + ', scrollTop: ' + $(window).scrollTop() );
  
  $.doTimeout( 'scroll', 250, function(){
    dt_scroll++;
    
    $('#text-scroll-2').html( 'doTimeout, 250ms delay, fired: ' + dt_scroll + ' times<br/>window scrollLeft: ' + $(window).scrollLeft() + ', scrollTop: ' + $(window).scrollTop() );
  });
});

$(window).scroll();

<?
$shell['script3'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" src="../../jquery.ba-dotimeout.js"></script>
<script type="text/javascript" language="javascript">

$(function(){
  
  <?= $shell['script1']; ?>
  
  <?= $shell['script2']; ?>
  
  <?= $shell['script3']; ?>
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
});

</script>
<style type="text/css" title="text/css">

/*
bg: #FDEBDC
bg1: #FFD6AF
bg2: #FFAB59
orange: #FF7F00
brown: #913D00
lt. brown: #C4884F
*/

#page {
  width: 800px;
  padding: 0 1000px 1000px 0;
}

pre, div.syntaxhighlighter {
  float: right !important;
  width: 450px !important;
  margin-left: 1em !important;
}

div.hr {
  clear: both;
}

</style>
<?
$shell['html_head'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML BODY
// ========================================================================== //

ob_start();
?>
<?= $shell['donate'] ?>

<p>
  Here are some simple debouncing examples, utilizing doTimeout. For more usage examples, also see the <a href="http://benalman.com/projects/jquery-dotimeout-plugin/">doTimeout plugin page</a>.
</p>

<div class="test clear">

<h3>Typing into a textfield (250ms delay)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script1'] ); ?>
</pre>
<p id="text-type">Go ahead, type!</p>
<form action="" method="get">
  <input type="text" name="whatever">
</form>

<div class="hr"><hr></div>

<h3>Window resize (some browsers fire this event continually)</h3>
<pre class="brush:js">
$(window).resize(function(){
  $.doTimeout( 'resize', 250, function(){
    // do something computationally expensive
  });
});
</pre>
<p id="text-resize-1"></p>
<p id="text-resize-2"></p>

<div class="hr"><hr></div>

<h3>Window scroll (most browsers fire this event continually)</h3>
<pre class="brush:js">
$(window).scroll(function(){
  $.doTimeout( 'scroll', 250, function(){
    // do something computationally expensive
  });
});
</pre>
<p id="text-scroll-1"></p>
<p id="text-scroll-2"></p>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
