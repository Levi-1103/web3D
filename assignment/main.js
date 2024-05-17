import * as THREE from 'three';
import {GUI} from 'three/addons/libs/lil-gui.module.min.js';
import {GLTFLoader} from 'three/addons/loaders/GLTFLoader.js';
import {OrbitControls} from 'three/addons/controls/OrbitControls.js';
import {RGBELoader} from 'three/addons/loaders/RGBELoader.js';

let renderer, scene, camera;
let model;
let spotLight;
let rotation = false;

init();

document.getElementById('modelContainer').hidden = true;
function init() {
  let canvasReference = document.getElementById('modelCanvas');
  renderer = new THREE.WebGLRenderer({antialias: true, canvas: canvasReference});

  renderer.setSize(canvasReference.clientWidth, canvasReference.clientHeight);
  renderer.setClearColor(0xffffff, 1);
  renderer.setPixelRatio(window.devicePixelRatio);

  renderer.shadowMap.enabled = true;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;

  renderer.toneMapping = THREE.ACESFilmicToneMapping;
  renderer.toneMappingExposure = 1;

  renderer.setAnimationLoop(render);

  scene = new THREE.Scene();

  camera = new THREE.PerspectiveCamera(
    40,
    canvasReference.clientWidth / canvasReference.clientHeight,
    0.1,
    100
  );

  camera.position.set(7, 3, 10);

  const controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.enablePan = false;
  controls.autoRotate = true;
  controls.maxDistance = 20;
  controls.minDistance = 1;
  controls.target.set(0, 0, 0);
  controls.update();

  const loader = new GLTFLoader().setPath('./public/3Dmodels/');

  async function loadModel(path) {
    return new Promise((res, rej) => loader.load(path, res, console.log('loading models'), rej));
  }

  async function addModel() {
    const [cola, sprite, drpepper] = await Promise.all(
      ['cola.glb', 'sprite.glb', 'drpepper.glb'].map(loadModel)
    );

    cola.scene.name = 'Cola';
    sprite.scene.name = 'Sprite';
    drpepper.scene.name = 'DrPepper';

    cola.scene.visible = true;
    sprite.scene.visible = false;
    drpepper.scene.visible = false;

    scene.add(cola.scene);
    scene.add(sprite.scene);
    scene.add(drpepper.scene);

    console.log(scene.children[0]);
  }

  addModel();

  new RGBELoader().setPath('./public/hdrs/').load('light.hdr', function (texture) {
    texture.mapping = THREE.EquirectangularReflectionMapping;

    scene.background = texture;
    scene.environment = texture;

    render();
  });

  window.addEventListener('resize', onWindowResize);

  const gui = new GUI({
    container: document.getElementById('guiContainer'),
    title: 'Model Controls',
  });

  let obj = {
    Front: () => {
      camera.position.set(0, 0, 10);

      controls.target.set(0, 0, 0);
      controls.update();
    },
    Back: () => {
      camera.position.set(0, 0, -10);
      controls.target.set(0, 0, 0);
      controls.update();
    },

    Left: () => {
      camera.position.set(10, 0, 0);
      controls.target.set(0, 0, 0);

      controls.update();
    },

    Right: () => {
      camera.position.set(-10, 0, 0);
      controls.target.set(0, 0, 0);
      controls.update();
    },

    Top: () => {
      camera.position.set(0, 10, 0);
      controls.target.set(0, 0, 0);
      controls.update();
    },

    Bottom: () => {
      camera.position.set(0, -10, 0);
      controls.target.set(0, 0, 0);
      controls.update();
      console.log('bottom');
    },

    Animate: false,
    Wireframe: false,
  };

  gui.add(obj, 'Front');
  gui.add(obj, 'Back');
  gui.add(obj, 'Left');
  gui.add(obj, 'Right');
  gui.add(obj, 'Top');
  gui.add(obj, 'Bottom');

  gui.add(obj, 'Animate').onChange(val => {
    rotation = val;
  });

  gui.add(obj, 'Wireframe').onChange(val => {
    for (let i = 0; i < scene.children.length; i++) {
      let model = scene.children[i];

      if (val) {
        model.traverse(function (object) {
          if (!object.isMesh) return;
          var wireframeGeometry = new THREE.WireframeGeometry(object.geometry);
          var wireframeMaterial = new THREE.LineBasicMaterial({color: 'black'});
          var wireframe = new THREE.LineSegments(wireframeGeometry, wireframeMaterial);
          object.add(wireframe);
        });
      } else {
        model.traverse(function (object) {
          if (!object.isMesh) return;

          object.clear();
        });
      }
    }
  });

  gui.open();

  // const axesHelper = new THREE.AxesHelper(5);
  // scene.add(axesHelper);
}

function onWindowResize() {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
}

function render() {
  renderer.render(scene, camera);

  for (let i = 0; i < scene.children.length; i++) {
    if (scene.children[i].visible) {
      if (rotation) {
        let model = scene.children[i];
        model.rotation.y += 0.01;
      }
    }
  }
}

document.getElementById('navHome').addEventListener('click', event => {
  hideMainContent();
  document.getElementById('homeContent').hidden = false;
});

document.getElementById('viewContentButton').addEventListener('click', event => {
  hideMainContent();
  hideCards();
  document.getElementById('modelContainer').hidden = false;
  document.getElementById('coke-card').hidden = false;
});

document.getElementById('navModels').addEventListener('click', event => {
  hideMainContent();
  hideCards();
  document.getElementById('modelContainer').hidden = false;
  document.getElementById('coke-card').hidden = false;
});

document.getElementById('navAbout').addEventListener('click', event => {
  hideMainContent();
  hideCards();
  document.getElementById('aboutContent').hidden = false;
});

document.getElementById('colaButton').addEventListener('click', event => {
  hideModelsInScene();
  scene.getObjectByName('Cola').visible = true;
  hideCards();
  document.getElementById('coke-card').hidden = false;
});

document.getElementById('spriteButton').addEventListener('click', event => {
  hideModelsInScene();
  scene.getObjectByName('Sprite').visible = true;
  hideCards();
  document.getElementById('sprite-card').hidden = false;
});

document.getElementById('drpepperButton').addEventListener('click', event => {
  hideModelsInScene();
  scene.getObjectByName('DrPepper').visible = true;
  hideCards();
  document.getElementById('drpepper-card').hidden = false;
});

function hideModelsInScene() {
  for (let i = 0; i < scene.children.length; i++) {
    scene.children[i].visible = false;
  }
}

function hideMainContent() {
  document.getElementById('homeContent').hidden = true;
  document.getElementById('modelContainer').hidden = true;
  document.getElementById('aboutContent').hidden = true;
}

function hideCards() {
  document.getElementById('coke-card').hidden = true;
  document.getElementById('sprite-card').hidden = true;
  document.getElementById('drpepper-card').hidden = true;
}
