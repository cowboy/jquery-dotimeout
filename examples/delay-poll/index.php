<?PHP

include "../index.php";

$shell['title3'] = "Delays &amp; Polling Loops";

$shell['h2'] = 'For when setTimeout just isn\'t good enough!';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$('#set_timeout1 a.start').click(function(){
  // In one second, do something!
  $.doTimeout( 1000, function(){
    $('#set_timeout1 span').html( 'done!' );
  });
});
<?
$shell['script1'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$('#set_timeout2 a.start').click(function(){
  // Execute .css( 'color', 'blue' ), now then in
  // one second, execute .css( 'color', 'blue' ).
  $('#set_timeout2 span')
    .css( 'color', 'red' )
    .doTimeout( 1000, function(){
      this.css( 'color', 'blue' )
    });
});
<?
$shell['script2'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$('#set_timeout2a a.start').click(function(){
  // Execute .css( 'color', 'blue' ), now then in
  // one second, execute .css( 'color', 'blue' ).
  $('#set_timeout2a span')
    .css( 'color', 'red' )
    .doTimeout( 1000, 'css', 'color', 'blue' );
});
<?
$shell['script2a'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
var counter1 = 0;

$('#polling_loop1 a.start').click(function(){
  // Start a polling loop with a counter.
  $.doTimeout( 250, function(){
    $('#polling_loop1 span').html( ++counter1 );
    return true; // Poll.
  });
});
<?
$shell['script3'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
var counter2 = 0;

$('#polling_loop2 a.start').click(function(){
  // Start a polling loop with a counter.
  $.doTimeout( 250, function(){
    $('#polling_loop2 span').html( ++counter2 );
    if ( counter2 < 50 ) { return true; } // Poll.
  });
});
<?
$shell['script4'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$('#polling_loop3 a.start').click(function(){
  // Start a polling loop with an id of 'loop' and a counter.
  var i = 0;
  $.doTimeout( 'loop', 500, function(){
    $('#polling_loop3 span').html( ++i );
    return true;
  });
});

$('#polling_loop3 a.force').click(function(){
  // Prematurely force execution of next polling loop iteration.
  $.doTimeout( 'loop', true );
});

$('#polling_loop3 a.cancel').click(function(){
  // Cancel the polling loop with id of 'loop'.
  $.doTimeout( 'loop' );
});
<?
$shell['script5'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
var elem = $('#polling_loop4');

elem.find('a.start').click(function(){
  // Start a polling loop with an id of 'loop' and a counter.
  var i = 0;
  elem.doTimeout( 'loop', 500, function(){
    this.find('span').html( ++i );
    return true;
  });
});

elem.find('a.force').click(function(){
  // Prematurely force execution of next polling loop iteration.
  elem.doTimeout( 'loop', true );
});

elem.find('a.cancel').click(function(){
  // Cancel the polling loop with id of 'loop'.
  elem.doTimeout( 'loop' );
});
<?
$shell['script6'] = ob_get_contents();
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
  
  <?= $shell['script2a']; ?>
  
  <?= $shell['script3']; ?>
  
  <?= $shell['script4']; ?>
  
  <?= $shell['script5']; ?>
  
  <?= $shell['script6']; ?>
  
  $('a[href=#]').click(function(e){
    e.preventDefault();
  });
  
  $('a.single').click(function(){
    $(this).replaceWith( 'Started!' );
  });
  
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
  Here are some simple delay and polling loop examples, utilizing doTimeout. For more usage examples, also see the <a href="http://benalman.com/projects/jquery-dotimeout-plugin/">doTimeout plugin page</a>.
</p>

<div class="test clear">

<h3>Like setTimeout, but better!</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script1'] ); ?>
</pre>
<div id="set_timeout1">
  <p>Set value: <span>???</span></p>
  <p><a href="#" class="start single">Start</a></p>
  <p>
    This works exactly like setTimeout, except that you can pass additional callback arguments
    as parameters to doTimeout, which will actually be passed into the callback in all browsers!
    (setTimeout doesn't quite get this right in all browsers).
  </p>
</div>

<div class="hr"><hr></div>

<h3>Like setTimeout, but on a jQuery object</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script2'] ); ?>
</pre>
<div id="set_timeout2">
  <p>Set value: <span>Some text</span>, <span>more text</span></p>
  <p><a href="#" class="start">Start</a></p>
  <p>
    Much like setTimeout or the example above, except that in the callback, `this`
    refers to the jQuery object. Chainable, too!
  </p>
</div>

<div class="hr"><hr></div>

<h3>An even easier syntax!</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script2a'] ); ?>
</pre>
<div id="set_timeout2a">
  <p>Set value: <span>Some text</span>, <span>more text</span></p>
  <p><a href="#" class="start">Start</a></p>
  <p>
    Much like setTimeout or the example above, except with a much more concise
    "string method" syntax. Still chainable!
  </p>
</div>

<div class="hr"><hr></div>

<h3>Basic polling loop (somewhat like setInterval.. but different)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script3'] ); ?>
</pre>
<div id="polling_loop1">
  <p>Polling loop counter: <span>???</span></p>
  <p><a href="#" class="start single">Start</a></p>
  <p>
    If you need to-the-millisecond loop timing accuracy, use setInterval, but beware that
    this may have unwanted side effects. For example, if the callback execution time takes
    longer than the delay (due to slow code or late execution), the next callback might
    execute immediately afterwards, which is almost never what you want in a polling loop!
  </p>
  <p>
    So.. for practical polling loops, use doTimeout. All you need to do is return true,
    and doTimeout does the rest!
  </p>
</div>

<div class="hr"><hr></div>

<h3>Basic polling loop, with a built-in limit</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script4'] ); ?>
</pre>
<div id="polling_loop2">
  <p>Polling loop counter: <span>???</span></p>
  <p><a href="#" class="start single">Start</a></p>
  <p>
    This polling loop example is like the simple example above, except that the loop
    is automatically canceled after 50 iterations. This condition should, of course,
    be something actually useful.. but for this example, a simple counter does the trick.
  </p>
</div>

<div class="hr"><hr></div>

<h3>Cancelable polling loop</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script5'] ); ?>
</pre>
<div id="polling_loop3">
  <p>Polling loop counter: <span>???</span></p>
  <p><a href="#" class="start">(Re)start</a>, <a href="#" class="force">Force</a>, <a href="#" class="cancel">Cancel</a></p>
  <p>
    Unlike all the preceding doTimeout examples, this example uses an id ("loop") which allows
    it to be restarted, overridden, or canceled.
  </p>
  <p>
    Notice that once started, restarting the loop will first cancel the already-running loop,
    keeping things sane. Forcing the loop will cause the callback to be invoked immediately
    (continuing the polling loop), and canceling the loop will stop it immediately.
  </p>
</div>

<div class="hr"><hr></div>

<h3>Cancelable polling loop, but on a jQuery object</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script6'] ); ?>
</pre>
<div id="polling_loop4">
  <p>Polling loop counter: <span>???</span></p>
  <p><a href="#" class="start">(Re)start</a>, <a href="#" class="force">Force</a>, <a href="#" class="cancel">Cancel</a></p>
  <p>
    Much like the example above, except that in the callback, `this` refers to the
    jQuery object.
  </p>
  <p>
    Also, notice that when an id is used in doTimeout on a jQuery object,
    that id is specific to that object and will not override a $.doTimeout id of
    the same name or a different jQuery object's doTimeout id.
  </p>
</div>


<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
