<?php
/*--------------------------------------------------------------
>>> header.php：ヘッダーテンプレートパーツ
--------------------------------------------------------------*/?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
  </head>
  <body class="theme-light preload">
    <!-- svg-load -->
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display:none;">
      <defs>
        <!--
        This SVG is used in combination with some of the following libraries:
        Font Awesome Free 5.0.0 by @fontawesome - https://fontawesome.com
        License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
        -->
        <symbol id="fa-twitter" viewbox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></symbol>
        <symbol id="fa-check" viewbox="0 0 512 512"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"/></symbol>
        <symbol id="fa-folder" viewbox="0 0 512 512"><path d="M464 128H272l-54.63-54.63c-6-6-14.14-9.37-22.63-9.37H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48zm0 272H48V112h140.12l54.63 54.63c6 6 14.14 9.37 22.63 9.37H464v224z"/></symbol>
        <symbol id="fa-chevron" viewbox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></symbol>
        <symbol id="fa-search" viewbox="-287.758 -188.922 437.2 437.054"><path d="M 365.00,332.00 C 352.34,343.60 335.74,353.49 320.00,360.28 251.42,389.86 168.76,373.94 118.17,318.00 71.73,266.65 58.85,195.42 83.81,131.00 91.71,110.60 107.55,86.50 123.17,71.28 141.78,53.15 164.38,38.56 189.00,30.00 253.52,7.57 326.03,22.59 374.72,71.28 393.85,90.42 406.82,111.73 416.05,137.00 421.76,152.62 425.81,169.32 426.00,186.00 426.00,186.00 426.92,197.00 426.92,197.00 426.92,197.00 425.96,205.00 425.96,205.00 425.96,205.00 425.96,215.00 425.96,215.00 424.49,229.07 421.14,242.64 416.67,256.00 409.85,276.37 397.52,298.19 383.00,314.00 386.88,314.00 395.77,313.55 399.00,314.85 403.30,316.59 410.47,324.47 414.00,328.00 414.00,328.00 441.00,355.00 441.00,355.00 441.00,355.00 475.00,389.00 475.00,389.00 475.00,389.00 501.00,415.00 501.00,415.00 504.71,418.76 509.32,423.17 508.38,429.00 507.43,434.88 499.19,441.81 495.00,446.00 491.41,449.59 486.11,455.99 481.00,456.76 475.79,457.54 471.59,454.20 468.00,450.91 468.00,450.91 448.00,431.00 448.00,431.00 448.00,431.00 390.00,373.00 390.00,373.00 384.53,367.53 368.78,353.17 366.34,347.00 364.60,342.60 365.00,336.72 365.00,332.00 Z M 248.00,60.37 C 248.00,60.37 235.00,61.17 235.00,61.17 225.52,62.08 216.09,64.21 207.00,67.02 173.38,77.44 143.19,102.44 127.37,134.00 102.28,184.05 108.20,244.37 145.29,287.00 158.70,302.42 172.83,312.31 191.00,321.24 203.63,327.45 225.96,333.83 240.00,334.00 240.00,334.00 256.00,334.00 256.00,334.00 275.34,333.97 296.98,326.53 314.00,317.74 329.02,309.99 343.66,298.03 354.39,285.00 405.47,222.93 392.83,127.64 325.00,83.08 302.16,68.07 275.19,60.62 248.00,60.37 Z" transform="matrix(1, 0, 0, 1, -359.06192, -208.742538)"/></symbol>
        <symbol id="fa-clock" viewbox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></symbol>
        <symbol id="fa-repeat" viewbox="0 0 512 512"><path d="M256.455 8c66.269.119 126.437 26.233 170.859 68.685l35.715-35.715C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.75c-30.864-28.899-70.801-44.907-113.23-45.273-92.398-.798-170.283 73.977-169.484 169.442C88.764 348.009 162.184 424 256 424c41.127 0 79.997-14.678 110.629-41.556 4.743-4.161 11.906-3.908 16.368.553l39.662 39.662c4.872 4.872 4.631 12.815-.482 17.433C378.202 479.813 319.926 504 256 504 119.034 504 8.001 392.967 8 256.002 7.999 119.193 119.646 7.755 256.455 8z"/></symbol>
        <symbol id="fa-times" viewbox="0 0 352 512"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></symbol>
        <symbol id="fa-home" viewbox="0 0 576 512"><path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"/></symbol>
        <symbol id="fa-star" viewbox="0 0 576 512"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"/></symbol>
        <symbol id="fa-tag" viewbox="0 0 512 512"><path d="M0 252.118V48C0 21.49 21.49 0 48 0h204.118a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882L293.823 497.941c-18.745 18.745-49.137 18.745-67.882 0L14.059 286.059A48 48 0 0 1 0 252.118zM112 64c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48z"/></symbol>
        <symbol id="fa-clip" viewbox="0 0 448 512"><path d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z"/></symbol>
        <symbol id="fa-amount" viewbox="0 0 512 512"><path d="M304 416h-64a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm-128-64h-48V48a16 16 0 0 0-16-16H80a16 16 0 0 0-16 16v304H16c-14.19 0-21.37 17.24-11.29 27.31l80 96a16 16 0 0 0 22.62 0l80-96C197.35 369.26 190.22 352 176 352zm256-192H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h192a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm-64 128H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM496 32H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h256a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"/></symbol>
        <symbol id="fa-user" viewbox="0 0 448 512"><path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"/></symbol>
        <symbol id="fa-bell" viewbox="26.8 -244.741 382.003 437.253"><path d="M 274.00,68.00 C 274.00,58.85 272.74,45.00 276.83,37.00 285.93,19.23 311.90,18.09 323.36,34.00 329.77,42.90 328.00,57.35 328.00,68.00 340.62,69.78 351.67,74.09 363.00,79.75 397.28,96.90 423.69,127.50 433.11,165.00 435.46,174.36 436.43,183.43 437.09,193.00 437.09,193.00 438.00,203.00 438.00,203.00 438.00,203.00 438.00,216.00 438.00,216.00 438.04,241.53 446.02,275.63 458.31,298.00 462.32,305.30 468.60,313.82 474.17,320.00 483.86,330.75 492.34,336.42 491.99,352.00 491.58,369.58 478.28,377.97 462.00,378.00 462.00,378.00 191.00,378.00 191.00,378.00 191.00,378.00 139.00,378.00 139.00,378.00 121.03,377.91 109.57,367.26 110.01,349.00 110.35,335.09 122.94,325.96 131.25,316.00 142.07,303.02 149.12,288.98 154.33,273.00 159.44,257.34 163.97,232.41 164.00,216.00 164.02,203.29 164.33,190.58 166.27,178.00 170.20,152.57 180.43,131.50 197.13,112.00 199.98,108.67 202.75,105.22 206.01,102.29 214.36,94.79 224.99,86.84 235.00,81.76 247.25,75.53 260.29,69.93 274.00,68.00 Z M 435.00,337.00 C 427.23,324.58 421.52,316.77 415.31,303.00 404.16,278.28 399.75,250.81 397.91,224.00 397.91,224.00 397.00,214.00 397.00,214.00 397.00,214.00 397.00,201.00 397.00,201.00 396.96,176.64 387.91,153.19 371.71,135.01 368.27,131.15 361.29,125.51 357.00,122.43 323.22,98.14 277.48,98.50 244.00,123.16 239.33,126.60 233.17,131.63 229.44,136.00 220.43,146.56 212.61,159.53 208.92,173.00 205.25,186.40 205.02,197.35 205.00,211.00 205.00,211.00 202.72,241.00 202.72,241.00 200.12,261.86 195.36,283.76 186.69,303.00 180.85,315.95 174.39,325.19 167.00,337.00 167.00,337.00 435.00,337.00 435.00,337.00 Z M 246.00,406.00 C 246.00,406.00 356.00,406.00 356.00,406.00 353.28,421.18 352.20,430.87 340.91,443.00 318.78,466.77 278.72,465.68 258.52,440.00 248.69,427.51 248.60,420.47 246.00,406.00 Z" transform="matrix(1, 0, 0, 1, -83.197647, -267.563202)"/></symbol>
        <symbol id="fa-external-link" viewbox="121.037 -272.778 437.992 438"><path d="M 421.00,80.00 C 421.00,80.00 399.00,58.99 399.00,58.99 395.67,55.74 379.76,39.00 378.31,36.00 375.98,31.14 377.90,24.82 383.04,22.74 385.03,21.93 387.86,22.01 390.00,22.00 390.00,22.00 412.00,21.00 412.00,21.00 412.00,21.00 426.00,21.00 426.00,21.00 426.00,21.00 441.00,21.96 441.00,21.96 441.00,21.96 455.00,21.96 455.00,21.96 455.00,21.96 467.00,21.04 467.00,21.04 467.00,21.04 484.00,21.04 484.00,21.04 484.00,21.04 494.00,22.00 494.00,22.00 502.47,22.10 511.53,20.00 513.89,31.00 514.05,33.02 514.00,35.90 513.89,38.00 513.89,38.00 513.89,144.00 513.89,144.00 513.99,146.66 514.07,149.46 512.99,151.96 510.22,158.42 502.36,159.47 497.00,155.57 497.00,155.57 482.00,141.00 482.00,141.00 482.00,141.00 455.00,114.00 455.00,114.00 450.52,120.26 438.05,131.95 432.00,138.00 432.00,138.00 391.00,179.00 391.00,179.00 391.00,179.00 263.00,307.00 263.00,307.00 263.00,307.00 230.00,340.00 230.00,340.00 225.87,344.11 220.48,350.14 214.00,349.30 208.18,348.54 201.12,340.12 197.00,336.00 194.14,333.14 187.90,327.56 186.60,324.00 183.48,315.50 191.78,309.22 197.00,304.00 197.00,304.00 240.00,261.00 240.00,261.00 240.00,261.00 421.00,80.00 421.00,80.00 Z M 115.00,76.14 C 115.00,76.14 162.00,76.14 162.00,76.14 162.00,76.14 249.00,76.14 249.00,76.14 254.02,76.01 258.75,75.88 262.85,79.42 270.12,85.77 270.08,107.32 262.85,113.72 258.92,117.27 254.94,116.99 250.00,117.00 250.00,117.00 148.00,117.00 148.00,117.00 148.00,117.00 128.00,117.00 128.00,117.00 124.46,117.05 120.98,117.14 118.60,120.23 116.71,122.67 117.01,126.08 117.00,129.00 117.00,129.00 117.00,351.00 117.00,351.00 117.00,351.00 117.00,407.00 117.00,407.00 117.07,416.66 119.93,417.98 129.00,418.00 129.00,418.00 351.00,418.00 351.00,418.00 351.00,418.00 408.00,418.00 408.00,418.00 417.69,417.86 417.99,414.64 418.00,406.00 418.00,406.00 418.00,287.00 418.00,287.00 418.02,275.31 420.97,268.07 434.00,268.00 434.00,268.00 444.00,268.00 444.00,268.00 455.96,268.16 458.98,274.06 459.00,285.00 459.00,285.00 459.00,416.00 459.00,416.00 458.96,440.63 443.33,458.96 418.00,459.00 418.00,459.00 155.00,459.00 155.00,459.00 155.00,459.00 129.00,459.00 129.00,459.00 129.00,459.00 115.00,459.00 115.00,459.00 102.39,458.84 89.89,451.44 82.95,441.00 81.01,438.08 79.15,434.37 78.17,431.00 76.51,425.31 76.01,420.88 76.00,415.00 76.00,415.00 76.00,159.00 76.00,159.00 76.00,159.00 76.00,132.00 76.00,132.00 76.00,110.16 76.42,91.74 99.00,80.38 105.23,77.24 108.50,77.37 115.00,76.14 Z" transform="matrix(1, 0, 0, 1, 45.036755, -293.778168)"/></symbol>
        <symbol id="fa-quote" viewbox="526.748 168.217 167.227 118.905"><path d="M 549.827 217.218 C 550.727 206.208 555.217 197.658 565.827 193.098 C 572.917 190.048 582.437 192.748 585.317 183.218 C 586.877 178.068 585.197 171.088 579.807 168.958 C 577.807 168.158 574.977 168.218 572.827 168.218 C 560.137 168.218 551.297 172.158 541.917 180.658 C 524.747 196.208 526.827 216.418 526.827 237.218 C 526.827 247.318 526.247 256.618 530.287 266.218 C 535.987 279.738 552.257 289.058 566.827 286.778 C 601.187 281.418 605.517 243.008 587.657 225.398 C 581.487 219.318 570.537 214.928 561.827 215.318 C 561.827 215.318 549.827 217.218 549.827 217.218 Z M 645.827 217.218 C 646.727 206.208 651.217 197.658 661.827 193.098 C 668.917 190.048 678.437 192.748 681.317 183.218 C 682.877 178.068 681.197 171.088 675.807 168.958 C 673.807 168.158 670.977 168.218 668.827 168.218 C 656.137 168.218 647.297 172.158 637.917 180.658 C 620.747 196.208 622.827 216.418 622.827 237.218 C 622.827 247.318 622.247 256.618 626.287 266.218 C 631.987 279.738 648.257 289.058 662.827 286.778 C 697.187 281.418 701.517 243.008 683.657 225.398 C 677.487 219.318 666.537 214.928 657.827 215.318 C 657.827 215.318 645.827 217.218 645.827 217.218 Z"/></symbol>
        <symbol id="fa-code" viewBox="0 0 640 512"><path d="M414.8 40.79L286.8 488.8C281.9 505.8 264.2 515.6 247.2 510.8C230.2 505.9 220.4 488.2 225.2 471.2L353.2 23.21C358.1 6.216 375.8-3.624 392.8 1.232C409.8 6.087 419.6 23.8 414.8 40.79H414.8zM518.6 121.4L630.6 233.4C643.1 245.9 643.1 266.1 630.6 278.6L518.6 390.6C506.1 403.1 485.9 403.1 473.4 390.6C460.9 378.1 460.9 357.9 473.4 345.4L562.7 256L473.4 166.6C460.9 154.1 460.9 133.9 473.4 121.4C485.9 108.9 506.1 108.9 518.6 121.4V121.4zM166.6 166.6L77.25 256L166.6 345.4C179.1 357.9 179.1 378.1 166.6 390.6C154.1 403.1 133.9 403.1 121.4 390.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4L121.4 121.4C133.9 108.9 154.1 108.9 166.6 121.4C179.1 133.9 179.1 154.1 166.6 166.6V166.6z"/></symbol>
        <symbol id="fa-pen" viewBox="0 0 512 512"><path d="M421.7 220.3L188.5 453.4L154.6 419.5L158.1 416H112C103.2 416 96 408.8 96 400V353.9L92.51 357.4C87.78 362.2 84.31 368 82.42 374.4L59.44 452.6L137.6 429.6C143.1 427.7 149.8 424.2 154.6 419.5L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3zM492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75z"/></symbol>
        <symbol id="fa-game" viewBox="0 0 640 512"><path d="M448 64H192C85.96 64 0 149.1 0 256s85.96 192 192 192h256c106 0 192-85.96 192-192S554 64 448 64zM247.1 280h-32v32c0 13.2-10.78 24-23.98 24c-13.2 0-24.02-10.8-24.02-24v-32L136 279.1C122.8 279.1 111.1 269.2 111.1 256c0-13.2 10.85-24.01 24.05-24.01L167.1 232v-32c0-13.2 10.82-24 24.02-24c13.2 0 23.98 10.8 23.98 24v32h32c13.2 0 24.02 10.8 24.02 24C271.1 269.2 261.2 280 247.1 280zM431.1 344c-22.12 0-39.1-17.87-39.1-39.1s17.87-40 39.1-40s39.1 17.88 39.1 40S454.1 344 431.1 344zM495.1 248c-22.12 0-39.1-17.87-39.1-39.1s17.87-40 39.1-40c22.12 0 39.1 17.88 39.1 40S518.1 248 495.1 248z"/></symbol>
      </defs>
    </svg>
    
    <!-- header -->
    <?php get_template_part('template-parts/header'); ?>