function popupCenter(url, title, w, h) {
  var left = screen.width / 2 - w / 2;
  var top = screen.height / 2 - h / 2;
  return;
  window.open(
    url,
    title,
    "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=" +
      w +
      ", height=" +
      h +
      ", top=" +
      top +
      ", left=" +
      left
  );
}

function previewImage(event, id_image) {
  const image = event.target.files[0];
  if (image) {
    const elt_image = document.getElementById(id_image);
    elt_image.src = URL.createObjectURL(image);
  }
}


function getIdChecked(name_element){
  let checkboxes = document.getElementsByName('role');
      let id;
      checkboxes.forEach((item) => {
          if(item.checked==true){
              id = item.value;
          }
      });
}
//this function allow user to check only 1 role.Same  user cannot have many roles . 
const onlyOne = (checkbox) => {
  let checkboxes = document.getElementsByName(checkbox.name);
  checkboxes.forEach((item) => {
      if (item !== checkbox) {
          item.checked = false;
      }
  });
  checkbox.checked = true;
}
