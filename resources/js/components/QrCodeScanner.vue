import VueWebCam from 'vue-web-cam';
import jsQR from 'jsqr';

export default {
    components: {
        WebCam: VueWebCam,
    },
    data() {
        return {
            isCameraStarted: false,
        };
    },
    methods: {
        cameraStart() {
            this.isCameraStarted = true;
        },
        cameraStop() {
            this.isCameraStarted = false;
        },
        scanQRCode() {
            console.log('Button clicked!');
            // ทดสอบว่าปุ่มทำงานถูกต้องหรือไม่
        },
    },
};
