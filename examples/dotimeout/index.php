<?PHP

include "../index.php";

$shell['title3'] = "doTimeout";

$shell['h2'] = 'Like setTimeout, but better!';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$('#item-over a')
  .mouseenter(function(){
    $(this).doTimeout( 'hover', 500, function(){
      $(this).addClass( 'hover' );
    });
  })
  .mouseleave(function(){
    $(this).doTimeout( 'hover', 500, function(){
      $(this).removeClass( 'hover' );
    });
  });
<?
$shell['script1'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$('#items-over a')
  .mouseenter(function(){
    var that = $(this);
    $.doTimeout( 'hover', 500, function(){
      $('#items-over-text').html( that.html() );
    });
  })
  .mouseleave(function(){
    $.doTimeout( 'hover' );
  });
<?
$shell['script2'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
var default_text = $('#text-input').text();
$('form input').keyup(function(){
  $(this).doTimeout( 'text-hover', 250, function(){
    $('#text-input').text( $(this).val() || default_text );
  });
});
<?
$shell['script3'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
// Delayed resizing!

var resize = 0,
  dt_resize = 0;

function update_resize_text() {
  $('#text-resize').html( 'resize event fired: ' + resize + ' times<br/>doTimeout, 250ms delay: ' + dt_resize + ' times' );
};
update_resize_text();

$(window).resize(function(){
  resize++;
  update_resize_text();
  
  $.doTimeout( 'resize', 250, function(){
    dt_resize++;
    update_resize_text();
  });
});
<?
$shell['script4'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
// General element-specific doTimeout (vs setTimeout) example

function start1() {
  $('#timeout-sample')
    .doTimeout( 'sample', 3000, function(){
      debug.log( '#timeout-sample', 'color', 'green' );
      $(this).css( 'color', 'green' );
    })
    .css( 'color', 'red' );
  
  debug.log( '#timeout-sample', 'color', 'red' );
};

function start2() {
  $('#timeout-sample')
    .doTimeout( 'sample', 2000, function(){
      debug.log( '#timeout-sample', 'color', 'blue' );
      $(this).css( 'color', 'blue' );
    })
    .css( 'color', 'magenta' );
  
  debug.log( '#timeout-sample', 'color', 'magenta' );
};

function start3() {
  $('#timeout-sample')
    .doTimeout( 'sample', 1000, function(){
      var random_color = '#'+('00'+(Math.random()*0x1000<<0).toString(16)).substr(-3);
      debug.log( '#timeout-sample', 'color', random_color );
      $(this).css( 'color', random_color );
      // returning true creates a polling loop, false cancels
      return true;
    });
};

function force_cancel() {
  var result = $('#timeout-sample').doTimeout( 'sample' );
  
  // true if canceled, undefined if already executed
  debug.log( 'cancel result:', result );
};

function force_poll() {
  var result = $('#timeout-sample').doTimeout( 'sample', true );
  
  // true if forced, undefined if already executed
  debug.log( 'force poll result:', result );
};

function force_nopoll() {
  var result = $('#timeout-sample').doTimeout( 'sample', false );
  
  // true if forced, undefined if already executed
  debug.log( 'force no poll result:', result );
};
<?
$shell['script5'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" src="../../jquery.ba-dotimeout.js"></script>
<script type="text/javascript" language="javascript">

<?= $shell['script5']; ?>

$(function(){
  
  <?= $shell['script1']; ?>
  <?= $shell['script2']; ?>
  <?= $shell['script3']; ?>
  <?= $shell['script4']; ?>
  
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
}

pre, div.syntaxhighlighter {
  float: right !important;
  width: 500px !important;
  margin-left: 1em !important;
}

div.hr {
  clear: both;
}

ul {
  width: 10em;
  margin-left: 0;
  padding-left: 0;
}

li {
  margin-bottom: 1px;
  list-style-type: none !important;
  margin-left: 0;
  padding-left: 0;
}

li a {
  display: block;
  color: #000 !important;
  text-decoration: none;
  border: 1px solid #ddd;
  padding: 1px;
}

#item-over a.hover,
#items-over a:hover {
  border-color: #0a0;
  background: #afa;
}

#timeout-sample {
  font-weight: 700;
  font-size: 200%;
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

<p>
  For more basic usage examples, also see the <a href="http://benalman.com/projects/jquery-dotimeout-plugin/">doTimeout plugin page</a>.
</p>

<div class="test">

<h3>Hover intent on individual items (500ms delay)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script1'] ); ?>
</pre>
<ul id="item-over">
  <li><a href="#">Alpha</a></li>
  <li><a href="#">Bravo</a></li>
  <li><a href="#">Charlie</a></li>
  <li><a href="#">Delta</a></li>
  <li><a href="#">Echo</a></li>
  <li><a href="#">Foxtrot</a></li>
</ul>

<div class="hr"><hr></div>

<h3>Hover intent on a group of items (500ms delay)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script2'] ); ?>
</pre>
<p id="items-over-text">Go ahead, hover!</p>
<ul id="items-over">
  <li><a href="#">Golf</a></li>
  <li><a href="#">Hotel</a></li>
  <li><a href="#">India</a></li>
  <li><a href="#">Juliet</a></li>
  <li><a href="#">Kilo</a></li>
  <li><a href="#">Lima</a></li>
</ul>

<div class="hr"><hr></div>

<h3>Typing into a textfield (250ms delay)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script3'] ); ?>
</pre>
<p id="text-input">Go ahead, type!</p>
<form action=''>
  <input type="text" name="whatever">
</form>

<div class="hr"><hr></div>

<h3>Window resize (IE and Safari fire this event continually)</h3>
<pre class="brush:js">
$(window).resize(function(){
  $.doTimeout( 'resize', 250, function(){
    // do something computationally expensive
  });
});
</pre>
<p id="text-resize"></p>

<div class="hr"><hr></div>

<h3>General element-specific doTimeout (vs setTimeout) example</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script5'] ); ?>
</pre>
<p>
  <a href="#" onclick="start1(); return false;">start1() - initialize doTimeout</a> (red -&gt; green)<br>
  <a href="#" onclick="start2(); return false;">start2() - initialize doTimeout</a> (pink -&gt; blue)<br>
  <a href="#" onclick="start3(); return false;">start3() - initialize doTimeout</a> (random colors)<br>
  <a href="#" onclick="force_cancel(); return false;">force_cancel() - cancel</a><br>
  <a href="#" onclick="force_poll(); return false;">force_poll() - force, polling loop may continue</a><br>
  <a href="#" onclick="force_nopoll(); return false;">force_nopoll() - force, polling loop is canceled</a><br>
</p>
<p id="timeout-sample">Sample text!</p>
<p>
  start1(), start2() or start3() will override any existing 'sample' doTimeout <i>for that element</i> if
  its callback hasn't yet executed. For non-element-specific doTimeout, use $.doTimeout() instead of
  $(elem).doTimeout(). Random color code originally posted on <a href="http://paulirish.com/2009/random-hex-color-code-snippets/">Paul Irish's site</a>.
</p>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
