@extends('layout.masterlayout')
@section('content')


 <div class="container">
    <div class="row g-4 align-items-center">
      
      <!-- Left Side: 3D Rotating Cup -->
      <div class="col-md-7 d-flex justify-content-center align-items-center">
        <div id="cupCanvas"></div>
      </div>
      
      <!-- Right Side: Product Info -->
      <div class="col-md-5">
        <h2 id="productTitle">Custom Designed Cup</h2>
        <p class="text-muted">Your Design, Our Cup ☕</p>
        
        <h4 class="text-success mb-3">$24.99</h4>
        
        <p>
          Personalize your own cup with images and text.  
          The design wraps beautifully around the mug – perfect for gifts or daily use!
        </p>
        
        <ul class="list-unstyled">
          <li>✅ High-resolution wraparound printing</li>
          <li>✅ Durable ceramic material</li>
          <li>✅ Dishwasher & microwave safe</li>
          <li>✅ Worldwide shipping</li>
        </ul>
        
        <button class="btn btn-primary btn-lg mt-3">Buy Now</button>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/three@0.150.1/build/three.min.js"></script>
  <script>
    const savedDesign = localStorage.getItem("finalDesign");

    if (savedDesign) {
      const scene = new THREE.Scene();
      const container = document.getElementById("cupCanvas");

      // Camera
      const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 1000);
      camera.position.set(0, 0.5, 5); // lowered y to keep centered

      // Renderer
      const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
      renderer.setSize(container.clientWidth, container.clientHeight);
      container.appendChild(renderer.domElement);

      // Resize handler
      function onResize() {
        const width = container.clientWidth;
        const height = container.clientHeight;
        renderer.setSize(width, height);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
      }
      window.addEventListener("resize", onResize);
      onResize();

      // Lights
      const hemiLight = new THREE.HemisphereLight(0xffffff, 0x555555, 1.2);
      scene.add(hemiLight);
      const dirLight = new THREE.DirectionalLight(0xffffff, 0.8);
      dirLight.position.set(4, 6, 5);
      scene.add(dirLight);

      // Cup body (partial cylinder, leaves gap)
      const openAngle = Math.PI * 1.6;
      const geometry = new THREE.CylinderGeometry(1, 1, 2.2, 64, 1, true, 0, openAngle);

      const texture = new THREE.TextureLoader().load(savedDesign);
      texture.minFilter = THREE.LinearFilter;

      const material = new THREE.MeshStandardMaterial({
        map: texture,
        side: THREE.FrontSide,
        roughness: 0.4,
        metalness: 0.1
      });

      const cup = new THREE.Mesh(geometry, material);
      scene.add(cup);

      // Cup inside
      const innerMaterial = new THREE.MeshStandardMaterial({
        color: "#ffffff",
        side: THREE.BackSide,
        roughness: 0.5,
        metalness: 0.1
      });
      const cupInner = new THREE.Mesh(geometry.clone(), innerMaterial);
      scene.add(cupInner);

      // Base
      const base = new THREE.Mesh(
        new THREE.CircleGeometry(1, 64),
        new THREE.MeshStandardMaterial({ color: "#eeeeee" })
      );
      base.rotation.x = -Math.PI / 2;
      base.position.y = -1.1;
      scene.add(base);

      // Animation
      function animate() {
        requestAnimationFrame(animate);
        cup.rotation.y += 0.002;
        cupInner.rotation.y += 0.002;
        renderer.render(scene, camera);
      }
      animate();
    }
  </script>
  @endsection