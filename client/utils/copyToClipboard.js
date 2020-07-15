export default function(data) {
  return new Promise((resolve, reject) => {
    if (window.clipboardData && window.clipboardData.setData) {
      // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
      clipboardData.setData("Text", data);
      return resolve();
    } else if (
      document.queryCommandSupported &&
      document.queryCommandSupported("copy")
    ) {
      var textarea = document.createElement("textarea");
      textarea.textContent = data;
      textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in Microsoft Edge.
      document.body.appendChild(textarea);
      textarea.select();
      try {
        document.execCommand("copy"); // Security exception may be thrown by some browsers.
        return resolve();
      } catch (ex) {
        console.warn("Copy to clipboard failed.", ex);
        return reject(ex);
      } finally {
        document.body.removeChild(textarea);
      }
    }
  });
}
