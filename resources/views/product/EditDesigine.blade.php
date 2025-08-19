@extends('layout.masterlayout')
@section('content')
<div class="container">
    <h2 class="text-center mb-4">🖌️ Product Editor</h2>

    <!-- Toolbar -->
    <div class="toolbar d-flex flex-wrap gap-3 justify-content-center mb-4">
      <button id="addTextBtn" class="btn btn-primary">Add Text</button>
      <input type="file" id="uploadImg" accept="image/*" class="form-control w-auto">

      <select id="fontFamily" class="form-select w-auto">
        <option value="Arial">Arial</option>
        <option value="Courier New">Courier New</option>
        <option value="Times New Roman">Times New Roman</option>
      </select>

      <input type="color" id="fontColor" class="form-control form-control-color w-auto" value="#000000">
      
      <input type="number" id="fontSize" class="form-control w-auto" placeholder="Font Size" min="10" max="100">
    </div>

    <!-- Canvas -->
    <div class="d-flex justify-content-center">
      <canvas id="editorCanvas" width="800" height="500"></canvas>
      <div class="text-center mt-4">
  <button id="finishBtn" class="btn btn-success btn-lg">Finish Design</button>
</div>

    </div>
  </div>
<script>
  const canvas = new fabric.Canvas("editorCanvas", { preserveObjectStacking: true });
  let currentText = null; // keep track of last added/selected text

  // Load frame from query param
  const urlParams = new URLSearchParams(window.location.search);
  const frameUrl = urlParams.get("frame");

  if (frameUrl) {
    fabric.Image.fromURL(frameUrl, (img) => {
      img.scaleToWidth(canvas.width);
      img.scaleToHeight(canvas.height);
      img.selectable = false;
      img.evented = false;

      canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
        scaleX: canvas.width / img.width,
        scaleY: canvas.height / img.height,
        originX: "left",
        originY: "top",
      });
    });
  }

  // Add text
  document.getElementById("addTextBtn").addEventListener("click", () => {
    const text = new fabric.IText("Your Text", {
      left: 100,
      top: 100,
      fill: "#000000",
      fontSize: 24,
      fontFamily: "Arial",
    });
    canvas.add(text);
    canvas.setActiveObject(text);
    currentText = text; // store last added text
    canvas.renderAll();
  });

  // Track active object when clicked
  canvas.on("selection:created", (e) => {
    if (e.selected && e.selected[0].type === "i-text") {
      currentText = e.selected[0];
    }
  });
  canvas.on("selection:updated", (e) => {
    if (e.selected && e.selected[0].type === "i-text") {
      currentText = e.selected[0];
    }
  });

  // Upload image
  document.getElementById("uploadImg").addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (f) => {
      fabric.Image.fromURL(f.target.result, (img) => {
        img.scaleToWidth(200);
        canvas.add(img);
        canvas.centerObject(img);
        canvas.renderAll();
      });
    };
    reader.readAsDataURL(file);
  });

  // Change font family
  document.getElementById("fontFamily").addEventListener("change", (e) => {
    if (currentText) {
      currentText.set("fontFamily", e.target.value);
      canvas.renderAll();
    }
  });

  // Change font color
  document.getElementById("fontColor").addEventListener("input", (e) => {
    if (currentText) {
      currentText.set("fill", e.target.value);
      canvas.renderAll();
    }
  });

  // Change font size
  document.getElementById("fontSize").addEventListener("input", (e) => {
    if (currentText) {
      const size = parseInt(e.target.value, 10);
      if (!isNaN(size)) {
        currentText.set("fontSize", size);
        canvas.renderAll();
      }
    }
  });

  // Finish button - save design and go to product details page
document.getElementById("finishBtn").addEventListener("click", () => {
  // export canvas as PNG
  const dataURL = canvas.toDataURL({
    format: "png",
    quality: 1.0,
  });

  // Save to localStorage
  localStorage.setItem("finalDesign", dataURL);

  // Redirect to product details page
  window.location.href = "product-details.html";
});

</script>

@endsection