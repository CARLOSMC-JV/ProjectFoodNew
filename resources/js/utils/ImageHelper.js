export const SizeUnits = {
    KB: 1024,
    MB: 1024 ** 2,
    GB: 1024 ** 3,
};

export default {
    getSize(file) {
        return new Promise((resolve) => {
            const image = new Image();
            image.src = (window.URL || window.webkitURL).createObjectURL(file);
            image.onload = () => {
                resolve({
                    width: image.naturalWidth,
                    height: image.naturalHeight,
                    size: file.size,
                });
            };
        });
    },
    getFile(file) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = async (event) => {
                const data = {
                    original: file,
                    image: event.target.result,
                    meta: await this.getSize(file),
                };
                resolve(data);
            };
            reader.readAsDataURL(file);
        });
    },
    resize(image, type, width, height) {
        return new Promise((resolve) => {
            const img = document.createElement("img");
            img.onload = () => {
                const canvas = document.createElement("canvas");
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext("2d");

                ctx.drawImage(img, 0, 0, width, height);

                const dataURL = canvas.toDataURL(type);
                resolve(dataURL);
            };
            img.src = image;
        });
    },
    async imageToBlob(dataURL) {
        return await (await fetch(dataURL)).blob();
    },
    async imageToFile(dataURL, { name, type, size, lastModified, lastModifiedDate }) {
        const blob = await this.imageToBlob(dataURL);
        return new File([blob], name, {
            type,
            size,
            lastModified,
            lastModifiedDate,
        });
    },
    async urlToFile(dataURL) {
        const urlExtension = dataURL.split(/[#?]/)[0].split(".").pop().trim();
        const fileName = dataURL.split("/").pop().split("#")[0].split("?")[0];

        let fileMIME = "";

        switch (urlExtension) {
            case "pdf":
                fileMIME = "application/pdf";
                break;
            case "docx":
                fileMIME =
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
                break;
            case "doc":
                fileMIME = "application/msword";
                break;
            case "jpg":
                fileMIME = "image/jpeg";
                break;
            case "png":
                fileMIME = "image/png";
                break;
            case "mp4":
                fileMIME = "video/mp4"
            default:
                break;
        }

        const BLOB_FILE = await (await fetch(dataURL)).blob();

        const FILE = new File([BLOB_FILE], fileName, {
            type: fileMIME,
        });

        return FILE;
    },
    async check(image, validationSchema) {
        const { maxSize, w, h } = validationSchema;
        const [size, unit] = maxSize;
        const maxSizeInBytes = size * SizeUnits[unit];
        const { size: imageSize, w: imageW, h: imageH } = await this.getSize(image);
        let result = {
            success: true,
        };

        if (imageSize > maxSizeInBytes) {
            result = {
                success: false,
                error: `La imagen debe de pesar menos de ${size}${unit}`,
            };
        } else if (w !== imageW || h !== imageH) {
            result = {
                success: false,
                error: `La imagen debe tener ${w}x${h} píxeles`,
            };
        }

        return result;
    },
}