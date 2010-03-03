// Not sure why this isn't set by default in qunit.js..
QUnit.jsDump.HTML = false;

$(function(){ // START CLOSURE

// Update jQuery version on page.
$('#jq_version').text( $.fn.jquery );

var arr, expected, i, elems = $('<div/><div/><div/><div/><div/><div/><div/>');
 
// ======================================================================== //
// $.doTimeout
// ======================================================================== //
 
var test1 = $.test1_m = function ( a, b ) {
  arr.push( i, a, b );
  if ( ++i < a ) {
    return true;
  } else {
    start();
    same( arr, expected );
    same( this, window );
  }
};
 
function test2( a, b ) {
  arr.push( a, b );
  same( this, window );
  return a === 5;
};
 
test("$.doTimeout no id, polling", function() {
  arr = [];
  i = 0;
  expected = [
    undefined,
    0, 2, 3,
    1, 2, 3
  ];
  
  stop();
  arr.push( $.doTimeout( 100, test1, 2, 3 ) );
});
 
test("$.doTimeout no id, polling (string method)", function() {
  arr = [];
  i = 0;
  expected = [
    undefined,
    0, 2, 3,
    1, 2, 3
  ];
  
  stop();
  arr.push( $.doTimeout( 100, 'test1_m', 2, 3 ) );
});
 
test("$.doTimeout with id, polling (string method)", function() {
  arr = [];
  i = 0;
  expected = [
    undefined,
    0, 2, 3,
    1, 2, 3
  ];
  
  stop();
  arr.push( $.doTimeout( 'foo', 100, 'test1_m', 2, 3 ) );
});
 
test("$.doTimeout with id, polling", function() {
  arr = [];
  i = 0;
  expected = [
    undefined,
    0, 2, 3,
    1, 2, 3
  ];
  
  stop();
  arr.push( $.doTimeout( 'foo', 100, test1, 2, 3 ) );
});
 
test("$.doTimeout with id, polling (string method)", function() {
  arr = [];
  i = 0;
  expected = [
    undefined,
    0, 2, 3,
    1, 2, 3
  ];
  
  stop();
  arr.push( $.doTimeout( 'foo', 100, 'test1_m', 2, 3 ) );
});
 
test("$.doTimeout with id, canceled", function() {
  arr = [];
  i = 0;
  expected = [
    undefined, undefined,
    true,
    undefined
  ];
  
  stop();
  arr.push( $.doTimeout( 'foo' ) );
  arr.push( $.doTimeout( 'foo', 200, test2, 6, 7 ) );
  
  setTimeout( function(){
    arr.push( $.doTimeout( 'foo' ) );
    
    setTimeout( function(){
      arr.push( $.doTimeout( 'foo' ) );
      start();
      same( arr, expected );
    }, 300);
    
  }, 100);
  
});

test("$.doTimeout with id, polling, forced (false)", function() {
  arr = [];
  i = 0;
  expected = [
    undefined, undefined,
    5, 6,
      true,
    undefined
  ];
  
  stop();
  arr.push( $.doTimeout( 'foo', false ) );
  arr.push( $.doTimeout( 'foo', 200, test2, 5, 6 ) );
  
  setTimeout( function(){
    arr.push( $.doTimeout( 'foo', false ) );
    
    setTimeout( function(){
      arr.push( $.doTimeout( 'foo' ) );
      start();
      same( arr, expected );
    }, 300);
    
  }, 100);
  
});
 
test("$.doTimeout with id, polling, forced (true)", function() {
  arr = [];
  i = 0;
  expected = [
    undefined, undefined,
    5, 6,
      true,
    5, 6,
    true, undefined
  ];
  
  stop();
  arr.push( $.doTimeout( 'foo', true ) );
  arr.push( $.doTimeout( 'foo', 200, test2, 5, 6 ) );
  
  setTimeout( function(){
    arr.push( $.doTimeout( 'foo', true ) );
    
    setTimeout( function(){
      arr.push( $.doTimeout( 'foo' ) );
      arr.push( $.doTimeout( 'foo' ) );
      start();
      same( arr, expected );
    }, 300);
  
  }, 100);
  
});
 
test("simultaneous $.doTimeout calls", function() {
  arr = [];
  i = 0;
  expected = [
    undefined, undefined, undefined, undefined, undefined, undefined,
    5,
    5,
    6,
      true,
    3,
      true,
    2,
    4,
    undefined, undefined
  ];
  
  var test3 = $.test3_m = function( a ) {
    arr.push( a );
    same( this, window );
    return a === 5;
  };
  
  stop();
  arr.push( $.doTimeout( 'foo', 300, test3, 1 ) );
  arr.push( $.doTimeout( 'bar', 400, 'test3_m', 2 ) );
  arr.push( $.doTimeout( 'baz', 500, test3, 3 ) );
  arr.push( $.doTimeout( 'foo', 600, 'test3_m', 4 ) );
  arr.push( $.doTimeout( 'xyz', 80,  test3, 5 ) );
  
  arr.push( $.doTimeout( 200, function( a ){
    test3( a );
    arr.push( $.doTimeout( 'xyz' ) );
    arr.push( $.doTimeout( 'baz', false ) );
  }, 6 ) );
  
  setTimeout( function(){
    arr.push( $.doTimeout( 'xyz' ) );
    arr.push( $.doTimeout( 'baz' ) );
    start();
    same( arr, expected );
  }, 1000);
  
});
 
// ======================================================================== //
// $.fn.doTimeout
// ======================================================================== //
 
var test1a = $.fn.test1a_m = function( a, b ) {
  arr.push( i, this.length, a, b );
  if ( ++i < a ) {
    return true;
  } else {
    start();
    same( arr, expected );
    same( this, elems );
  }
};
 
function test2a( a, b ) {
  arr.push( this.length, a, b );
  same( this, elems );
  return a === 5;
};
 
test("$.fn.doTimeout no id, polling", function() {
  arr = [];
  i = 0;
  expected = [
    7,
    0, 7, 2, 3,
    1, 7, 2, 3
  ];
  
  stop();
  arr.push( elems.doTimeout( 100, test1a, 2, 3 ).length );
});
 
test("$.fn.doTimeout no id, polling (string method)", function() {
  arr = [];
  i = 0;
  expected = [
    7,
    0, 7, 2, 3,
    1, 7, 2, 3
  ];
  
  stop();
  arr.push( elems.doTimeout( 100, 'test1a_m', 2, 3 ).length );
});

test("$.fn.doTimeout with id, polling", function() {
  arr = [];
  i = 0;
  expected = [
    7,
    0, 7, 2, 3,
    1, 7, 2, 3
  ];
  
  stop();
  arr.push( elems.doTimeout( 'foo', 100, test1a, 2, 3 ).length );
});
 
test("$.fn.doTimeout with id, polling (string method)", function() {
  arr = [];
  i = 0;
  expected = [
    7,
    0, 7, 2, 3,
    1, 7, 2, 3
  ];
  
  stop();
  arr.push( elems.doTimeout( 'foo', 100, 'test1a_m', 2, 3 ).length );
});
 
test("$.fn.doTimeout with id, canceled", function() {
  arr = [];
  i = 0;
  expected = [
    undefined, 7,
    true,
    undefined
  ];
  
  stop();
  arr.push( elems.doTimeout( 'foo' ) );
  arr.push( elems.doTimeout( 'foo', 200, test2a, 6, 7 ).length );
  
  setTimeout( function(){
    arr.push( elems.doTimeout( 'foo' ) );
    
    setTimeout( function(){
      arr.push( elems.doTimeout( 'foo' ) );
      start();
      same( arr, expected );
    }, 300);
    
  }, 100);
  
});
 
test("$.fn.doTimeout with id, polling, forced (false)", function() {
  arr = [];
  i = 0;
  expected = [
    undefined, 7,
    7, 5, 6,
      true,
    undefined
  ];
  
  stop();
  arr.push( elems.doTimeout( 'foo', false ) );
  arr.push( elems.doTimeout( 'foo', 200, test2a, 5, 6 ).length );
  
  setTimeout( function(){
    arr.push( elems.doTimeout( 'foo', false ) );
    
    setTimeout( function(){
      arr.push( elems.doTimeout( 'foo' ) );
      start();
      same( arr, expected );
    }, 300);
    
  }, 100);
  
});
 
test("$.fn.doTimeout with id, polling, forced (true)", function() {
  arr = [];
  i = 0;
  expected = [
    undefined, 7,
    7, 5, 6,
      true,
    7, 5, 6,
    true, undefined
  ];
  
  stop();
  arr.push( elems.doTimeout( 'foo', true ) );
  arr.push( elems.doTimeout( 'foo', 200, test2a, 5, 6 ).length );
  
  setTimeout( function(){
    arr.push( elems.doTimeout( 'foo', true ) );
    
    setTimeout( function(){
      arr.push( elems.doTimeout( 'foo' ) );
      arr.push( elems.doTimeout( 'foo' ) );
      start();
      same( arr, expected );
    }, 300);
  
  }, 100);
  
});
 
test("simultaneous $.fn.doTimeout calls", function() {
  arr = [];
  i = 0;
  expected = [
    7, 7, 7, 7, 7, 7,
    7, 5,
    7, 5,
    7, 6,
      true,
    7, 3,
      true,
    7, 2,
    7, 4,
    undefined, undefined
  ];
  
  var test3a = $.fn.test3a_m = function( a ) {
    arr.push( this.length );
    arr.push( a );
    same( this, elems );
    return a === 5;
  };
  
  stop();
  arr.push( elems.doTimeout( 'foo', 300, test3a, 1 ).length );
  arr.push( elems.doTimeout( 'bar', 400, 'test3a_m', 2 ).length );
  arr.push( elems.doTimeout( 'baz', 500, test3a, 3 ).length );
  arr.push( elems.doTimeout( 'foo', 600, 'test3a_m', 4 ).length );
  arr.push( elems.doTimeout( 'xyz', 80,  test3a, 5 ).length );
  
  arr.push( elems.doTimeout( 200, function( a ){
    test3a.call( this, a );
    arr.push( elems.doTimeout( 'xyz' ) );
    arr.push( elems.doTimeout( 'baz', false ) );
  }, 6 ).length );
  
  setTimeout( function(){
    arr.push( elems.doTimeout( 'xyz' ) );
    arr.push( elems.doTimeout( 'baz' ) );
    start();
    same( arr, expected );
  }, 1000);
  
});


}); // END CLOSURE