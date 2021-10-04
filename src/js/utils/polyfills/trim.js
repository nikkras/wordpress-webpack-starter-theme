// ---------------------------------------------------------------
// TRIM POLYFILL
// ---------------------------------------------------------------

// http://www.jonathantneal.com/blog/polyfills-and-prototypes/
export default () => {
  !String.prototype.trim && (String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, '');
  });
}