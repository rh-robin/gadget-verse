import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';



const scene = new THREE.Scene();
scene.background = new THREE.Color(background);

// Instantiate a loader
const loader = new GLTFLoader();
// Load a glTF resource
loader.load(
	// resource URL
	modelPath,
	// called when the resource is loaded
	function ( glb ) {
    console.log(glb);
    const root = glb.scene;
    root.scale.set(scaleX,scaleY,scaleZ);
		scene.add( root );
    
		
	},
	// called while loading is progressing
	function ( xhr ) {
		console.log( ( xhr.loaded / xhr.total * 100 ) + '% loaded' );
	},
	// called when loading has errors
	function ( error ) {
		console.log( 'An error happened' );
	}
);

//light
const directionalLight = new THREE.DirectionalLight( directional_light_color, directional_light_opacity );
directionalLight.position.set(2,2,2);
scene.add( directionalLight );

const ambientLight = new THREE.AmbientLight( ambient_light_color, ambient_light_opacity ); 
scene.add( ambientLight );






// Camera
const sizes = {
    width: window.innerWidth,
    height: window.innerHeight
}
  
const camera = new THREE.PerspectiveCamera(75, 500/500,0.5,100);
camera.position.set(2,2,2);
//camera.position.z = 1;
scene.add(camera);




// Renderer
const canvas = document.querySelector('.webgl');
let canvasContainer = document.getElementById('canvas_container');





const renderer = new THREE.WebGLRenderer({
  canvas: canvas
})

renderer.setSize(500, 500);
renderer.setPixelRatio(Math.min(window.devicePixelRatio),2);
//renderer.shadowMap.enabled = true;
//renderer.gammaOutput = true;
//renderer.render(scene, camera);





const controls = new OrbitControls(camera, renderer.domElement);
//controls.panSpeed = 20;
//controls.rotationSpeed = 20;
controls.enableDamping = true;
//controls.enablePan = false;
//controls.autoRotate = true;
//controls.autoRotateSpeed = 5;
//controls.minDistance = 5;
//controls.maxDistance = 5;
//controls.minPolarAngle = 0.5;
//controls.maxPolarAngle = 1.5;
controls.target = new THREE.Vector3(target_x, target_y, target_z);



function animate(){
  controls.update();
  // Render
  renderer.render(scene, camera);

  // Call tick again on the next frame
  requestAnimationFrame(animate);
}
animate();


