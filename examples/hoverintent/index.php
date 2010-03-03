<?PHP

include "../index.php";

$shell['title3'] = "Hover Intent";

$shell['h2'] = 'So, you want an "over" state, but you don\'t want it "just yet."';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$('#item-over a').hover(function(){
  $(this).doTimeout( 'hover', 250, 'addClass', 'hover' );
}, function(){
  $(this).doTimeout( 'hover', 250, 'removeClass', 'hover' );
});
<?
$shell['script1'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$('#items-over a')
  .mouseenter(function(){
    $.doTimeout( 'hover', 250, function(elem){
      $('#items-over-text').html( $(elem).html() );
    }, this);
  })
  .mouseleave(function(){
    $.doTimeout( 'hover' );
  });
<?
$shell['script2'] = ob_get_contents();
ob_end_clean();

ob_start();
?>
$('ul.main-nav').each(function(){
  var nav = $(this);
  
  nav
    .mouseover(function(e){
      nav.doTimeout( 'main-nav', 250, over, e.target );
    }).mouseout(function(){
      nav.doTimeout( 'main-nav', 250, out );
    });
  
  function over( elem ) {
    var parent = $(elem).closest( 'li.main-nav' );
    
    out( parent );
    parent.children( 'a' ).addClass( 'hover' );
    parent.children( 'ul:hidden' ).slideDown( 'fast' );
  };
  
  function out( elem ) {
    var parents = elem
      ? $(elem).closest( 'li.main-nav' ).siblings()
      : nav.children();
    
    if ( nav.is( '.main-nav-horizontal' ) ) {
      parents = parents.not( '.active' );
    }
    
    parents.children( 'a' ).removeClass( 'hover' );
    parents.children( 'ul' ).hide();
  };
});
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
}

pre, div.syntaxhighlighter {
  float: right !important;
  width: 450px !important;
  margin-left: 1em !important;
}

div.hr {
  clear: both;
}

/* items grid */

ul.item {
  width: 330px;
  margin-left: 0;
  padding-left: 0;
}

ul.item li {
  list-style-type: none !important;
  padding: 0;
  float: left;
  width: 30px;
  margin: 0 1px 1px 0;
  text-align: center;
}

ul.item li a {
  display: block;
  color: #000 !important;
  text-decoration: none;
  border: 1px solid #ddd;
  width: 26px;
  padding: 1px;
}

#item-over a.hover,
#items-over a:hover {
  border-color: #0a0;
  background: #afa;
}

/* nav / subnav */

ul.main-nav,
ul.main-nav ul {
  margin: 0;
  padding: 0;
  float: left;
  width: 100%;
}

ul.main-nav {
  position: relative;
  background: #FFD6AF;
  line-height: 40px;
}

ul.main-nav li {
  display: inline;
  list-style: none;
}

ul.main-nav li.active a,
ul.main-nav li.active ul {
  color: #fff;
  background: #FFAB59;
}

ul.main-nav ul {
  display: none;
  position: absolute;
  top: 40px;
  line-height: 25px;
  color: #fff;
  background: #FF7F00;
}

ul.main-nav ul li {
  padding: 2px;
}

.main-nav-shim {
  clear: left;
  padding-bottom: 1em;
}

ul.main-nav a {
  text-decoration: none;
  color: #C4884F;
  font-weight: 700;
}

ul.main-nav a.hover {
  text-decoration: none;
  color: #fff;
  background: #FF7F00;
}

ul.main-nav ul a {
  color: #fff;
  font-weight: 400;
}

ul.main-nav ul a:hover {
  color: #fff;
  background: #913D00;
}

ul.main-nav ul a.selected {
  text-decoration: underline;
}

ul.main-nav li.main-nav a {
  float: left;
  padding: 0 1em;
  border-right: 1px solid #C4884F;
}

ul.main-nav li.main-nav ul li a {
  border: none;
}

/* horizontal-specific code */

ul.main-nav-horizontal {
  height: 69px;
}

ul.main-nav-horizontal ul {
  left: 0;
}

ul.main-nav-horizontal li.active ul {
  display: block;
}

ul.main-nav-horizontal ul li {
  padding-right: 2px;
  float: left;
  padding-right: 0;
}

/* vertical-specific code */

ul.main-nav-vertical li.main-nav {
  float: left;
  position: relative;
}

ul.main-nav-vertical ul {
  width: 8em;
  left: 0;
  padding-bottom: 2px;
}

ul.main-nav-vertical ul li {
  display: block;
  padding-bottom: 0;
  _zoom: 1;
}

ul.main-nav-vertical li.main-nav ul li a {
  float: none;
  display: block;
}

/* for this example only */
ul.main-nav {
  width: 320px;
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
  Here are some simple hover intent examples, utilizing doTimeout. For more usage examples, also see the <a href="http://benalman.com/projects/jquery-dotimeout-plugin/">doTimeout plugin page</a>.
</p>

<div class="test clear">

<h3>Hover intent on individual items (250ms delay)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script1'] ); ?>
</pre>
<ul id="item-over" class="item">
  <li><a href="#01">01</a></li><li><a href="#02">02</a></li><li><a href="#03">03</a></li>
  <li><a href="#04">04</a></li><li><a href="#05">05</a></li><li><a href="#06">06</a></li>
  <li><a href="#07">07</a></li><li><a href="#08">08</a></li><li><a href="#09">09</a></li>
  <li><a href="#10">10</a></li><li><a href="#11">11</a></li><li><a href="#12">12</a></li>
  <li><a href="#13">13</a></li><li><a href="#14">14</a></li><li><a href="#15">15</a></li>
  <li><a href="#16">16</a></li><li><a href="#17">17</a></li><li><a href="#18">18</a></li>
  <li><a href="#19">19</a></li><li><a href="#20">20</a></li><li><a href="#21">21</a></li>
  <li><a href="#22">22</a></li><li><a href="#23">23</a></li><li><a href="#24">24</a></li>
  <li><a href="#25">25</a></li><li><a href="#26">26</a></li><li><a href="#27">27</a></li>
  <li><a href="#28">28</a></li><li><a href="#29">29</a></li><li><a href="#30">30</a></li>
  <li><a href="#31">31</a></li><li><a href="#32">32</a></li><li><a href="#33">33</a></li>
  <li><a href="#34">34</a></li><li><a href="#35">35</a></li><li><a href="#36">36</a></li>
  <li><a href="#37">37</a></li><li><a href="#38">38</a></li><li><a href="#39">39</a></li>
  <li><a href="#40">40</a></li><li><a href="#41">41</a></li><li><a href="#42">42</a></li>
  <li><a href="#43">43</a></li><li><a href="#44">44</a></li><li><a href="#45">45</a></li>
  <li><a href="#46">46</a></li><li><a href="#47">47</a></li><li><a href="#48">48</a></li>
  <li><a href="#49">49</a></li><li><a href="#50">50</a></li><li><a href="#51">51</a></li>
  <li><a href="#52">52</a></li><li><a href="#53">53</a></li><li><a href="#54">54</a></li>
  <li><a href="#55">55</a></li><li><a href="#56">56</a></li><li><a href="#57">57</a></li>
  <li><a href="#58">58</a></li><li><a href="#59">59</a></li><li><a href="#60">60</a></li>
</ul>

<div class="hr"><hr></div>

<h3>Hover intent on a group of items (250ms delay)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script2'] ); ?>
</pre>
<p>Hovered over: <span id="items-over-text">???</span></p>
<ul id="items-over" class="item">
  <li><a href="#01">01</a></li><li><a href="#02">02</a></li><li><a href="#03">03</a></li>
  <li><a href="#04">04</a></li><li><a href="#05">05</a></li><li><a href="#06">06</a></li>
  <li><a href="#07">07</a></li><li><a href="#08">08</a></li><li><a href="#09">09</a></li>
  <li><a href="#10">10</a></li><li><a href="#11">11</a></li><li><a href="#12">12</a></li>
  <li><a href="#13">13</a></li><li><a href="#14">14</a></li><li><a href="#15">15</a></li>
  <li><a href="#16">16</a></li><li><a href="#17">17</a></li><li><a href="#18">18</a></li>
  <li><a href="#19">19</a></li><li><a href="#20">20</a></li><li><a href="#21">21</a></li>
  <li><a href="#22">22</a></li><li><a href="#23">23</a></li><li><a href="#24">24</a></li>
  <li><a href="#25">25</a></li><li><a href="#26">26</a></li><li><a href="#27">27</a></li>
  <li><a href="#28">28</a></li><li><a href="#29">29</a></li><li><a href="#30">30</a></li>
  <li><a href="#31">31</a></li><li><a href="#32">32</a></li><li><a href="#33">33</a></li>
  <li><a href="#34">34</a></li><li><a href="#35">35</a></li><li><a href="#36">36</a></li>
  <li><a href="#37">37</a></li><li><a href="#38">38</a></li><li><a href="#39">39</a></li>
  <li><a href="#40">40</a></li><li><a href="#41">41</a></li><li><a href="#42">42</a></li>
  <li><a href="#43">43</a></li><li><a href="#44">44</a></li><li><a href="#45">45</a></li>
  <li><a href="#46">46</a></li><li><a href="#47">47</a></li><li><a href="#48">48</a></li>
  <li><a href="#49">49</a></li><li><a href="#50">50</a></li><li><a href="#51">51</a></li>
  <li><a href="#52">52</a></li><li><a href="#53">53</a></li><li><a href="#54">54</a></li>
  <li><a href="#55">55</a></li><li><a href="#56">56</a></li><li><a href="#57">57</a></li>
  <li><a href="#58">58</a></li><li><a href="#59">59</a></li><li><a href="#60">60</a></li>
</ul>

<div class="hr"><hr></div>

<h3>Hover intent on a nav / subnav (250ms delay)</h3>
<pre class="brush:js">
<?= htmlspecialchars( $shell['script3'] ); ?>
</pre>
<ul class="main-nav main-nav-horizontal">
  <li class="main-nav active">
    <a href="#1">Section 1</a>
    <ul>
      <li><a href="#1a">Item 1a</a></li>
      <li><a href="#1b" class="selected">Item 1b</a></li>
      <li><a href="#1c">Item 1c</a></li>
    </ul>
  </li>
  <li class="main-nav">
    <a href="#2">Section 2</a>
    <ul>
      <li><a href="#2a">Item 2a</a></li>
      <li><a href="#2b">Item 2b</a></li>
      <li><a href="#2c">Item 2c</a></li>
    </ul>
  </li>
  <li class="main-nav">
    <a href="#3">Section 3</a>
    <ul>
      <li><a href="#3a">Item 3a</a></li>
      <li><a href="#3b">Item 3b</a></li>
      <li><a href="#3c">Item 3c</a></li>
    </ul>
  </li>
</ul>
<div class="main-nav-shim"></div>
<p>Sample Content</p>
<p>Sample Content</p>
<p>Sample Content</p>

<ul class="main-nav main-nav-vertical">
  <li class="main-nav active">
    <a href="#1">Section 1</a>
    <ul>
      <li><a href="#1a">Item 1a</a></li>
      <li><a href="#1b" class="selected">Item 1b</a></li>
      <li><a href="#1c">Item 1c</a></li>
    </ul>
  </li>
  <li class="main-nav">
    <a href="#2">Section 2</a>
    <ul>
      <li><a href="#2a">Item 2a</a></li>
      <li><a href="#2b">Item 2b</a></li>
      <li><a href="#2c">Item 2c</a></li>
    </ul>
  </li>
  <li class="main-nav">
    <a href="#3">Section 3</a>
    <ul>
      <li><a href="#3a">Item 3a</a></li>
      <li><a href="#3b">Item 3b</a></li>
      <li><a href="#3c">Item 3c</a></li>
    </ul>
  </li>
</ul>
<div class="main-nav-shim"></div>
<p>Sample Content</p>
<p>Sample Content</p>
<p>Sample Content</p>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
