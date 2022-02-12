export default class Functionality {
    constructor() {
        this.nav_dropdown();
        this.dropdown();
        this.carousel_lg();
        this.carousel_fade();
        this.carousel();
        this.counter();
        this.loading();
        this.zoom();
        this.links();
        this.fade_out();
        this.submit();
        this.format_int();
    }

    nav_dropdown() {
        // check
        if (!document.querySelector(".js-nav-dropdown-btn") ||
            !document.querySelector(".js-nav-dropdown-box")
        ) {
            return;
        }

        // html
        const btn = document.querySelector(".js-nav-dropdown-btn");
        const box = document.querySelector(".js-nav-dropdown-box");

        // toggle dropdown
        btn.addEventListener("click", function () {
            // open box
            if (box.classList.contains("d-none")) {
                box.classList.remove("d-none");
                setTimeout(() => {
                    box.classList.remove("ts-hide-top");
                    box.classList.remove("o-invisible");
                    btn.classList.remove("fa-bars");
                    btn.classList.add("fa-times");
                }, 100);
            }

            // close box
            else {
                box.classList.add("ts-hide-top");
                box.classList.add("o-invisible");
                btn.classList.add("fa-bars");
                btn.classList.remove("fa-times");
                setTimeout(() => {
                    box.classList.add("d-none");
                }, 500);
            }
        })

        // remove dropdown when resizing
        window.addEventListener("resize", function () {
            btn.classList.add("fa-bars");
            box.classList.add("ts-hide-top");
            box.classList.add("o-invisible");
            btn.classList.remove("fa-times");
            setTimeout(() => {
                box.classList.add("d-none");
            }, 500);
        })
    }

    dropdown() {
        // check
        if (!document.querySelector(".js-dropdown-btn") ||
            !document.querySelector(".js-dropdown-box")
        ) {
            return;
        }

        // html
        const btns = document.querySelectorAll(".js-dropdown-btn");

        // loop
        for (let i = 0; i < btns.length; i++) {
            const btn = btns[i];
            const box = btn.querySelector(".js-dropdown-box");
            const icon = btn.querySelector("i");

            // exe
            btn.addEventListener("click", function () {
                // open box
                if (box.classList.contains("d-none")) {
                    box.classList.remove("d-none");
                    setTimeout(() => {
                        box.classList.remove("o-invisible");
                        icon.classList.remove("fa-angle-down");
                        icon.classList.add("fa-angle-up");
                    }, 100);
                }

                // close box
                else {
                    box.classList.add("o-invisible");
                    icon.classList.add("fa-angle-down");
                    icon.classList.remove("fa-angle-up");
                    setTimeout(() => {
                        box.classList.add("d-none");
                    }, 500);
                }
            })

            window.addEventListener("resize", function () {
                box.classList.add("o-invisible");
                icon.classList.add("fa-angle-down");
                icon.classList.remove("fa-angle-up");
                setTimeout(() => {
                    box.classList.add("d-none");
                }, 500);
            })
        }
    }

    loading() {
        // check
        if (!document.querySelector(".js-loading")
        ) {
            return;
        }

        // html
        const loading = document.querySelector(".js-loading");
        const delay = 300;

        // exe
        window.addEventListener("load", function () {
            loading.style.animation = delay + "ms fade_out linear forwards"
            setTimeout(() => {
                loading.classList.add("d-none");
            }, delay);
        })
    }

    counter() {
        // check
        if (!document.querySelector(".js-counter")
        ) {
            return;
        }

        // vars
        const speed = 10;

        // html
        const counters = document.querySelectorAll(".js-counter");

        // loop
        for (let i = 0; i < counters.length; i++) {
            const counter = counters[i];
            const limit = counter.dataset.limit;
            counter.innerHTML = "0";

            // exe
            exe();

            // exe function
            function exe() {
                let count = parseInt(counter.innerHTML);
                if (count < limit) {
                    setTimeout(() => {
                        count++;
                        counter.innerHTML = count;
                        exe();
                    }, speed)
                } else {
                    return;
                }
            }
        }
    }

    carousel_lg() {
        // check
        if (!document.querySelector(".js-carousel-lg")) {
            return;
        }

        // html
        const carousels = document.querySelectorAll(".js-carousel-lg");
        const btn_class = "bg-primary";

        // loop
        for (let i = 0; i < carousels.length; i++) {
            //html
            const carousel = carousels[i];
            const slider = carousel.querySelector(".js-slider");
            const items = slider.querySelectorAll(".js-item");
            const paginations = carousel.querySelectorAll(".js-pagination-btn");
            const next = carousel.querySelector(".js-next");
            const prev = carousel.querySelector(".js-prev");

            // vars
            let index = 1;
            const limit = items.length - 1;
            const lag_delay = 100;


            // functions
            function exe() {
                // calculate dimensions
                const carousel_width = carousel.clientWidth;
                const carousel_height = carousel.clientHeight;
                for (let i = 0; i < items.length; i++) {
                    const item = items[i];
                    item.style.width = carousel_width + "px";
                    item.style.height = carousel_height + "px";
                }

                // checking position
                if (index == -1) {
                    index = limit - 1;
                    slider.classList.remove("a-ease-out-fast");
                    slider.style.transform =
                        "translateX(-" + index * carousel_width + "px)";
                    index--;
                }
                else if (index == limit + 1) {
                    index = 1;
                    slider.classList.remove("a-ease-out-fast");
                    slider.style.transform =
                        "translateX(-" + index * carousel_width + "px)";
                    index++;
                }

                //scrolling & pagination
                setTimeout(() => {
                    slider.classList.add("a-ease-out-fast");
                    slider.style.transform =
                        "translateX(-" + index * carousel_width + "px)";
                    check_pagination();
                }, lag_delay);
            }

            function check_pagination() {
                for (let i = 0; i < paginations.length; i++) {
                    const pagination = paginations[i];
                    if (index == 0) {
                        if (i == paginations.length - 1) {
                            pagination.classList.add(btn_class);
                        }
                        else {
                            pagination.classList.remove(btn_class);
                        }
                    }
                    else if (index == limit) {
                        if (i == 0) {
                            pagination.classList.add(btn_class);
                        }
                        else {
                            pagination.classList.remove(btn_class);
                        }
                    }
                    else {
                        if (index == i + 1) {
                            pagination.classList.add(btn_class);

                        } else {
                            pagination.classList.remove(btn_class);
                        }
                    }

                }
            }

            // exe
            for (let i = 0; i < paginations.length; i++) {
                const pagination = paginations[i];
                pagination.addEventListener("click", function () {
                    index = i + 1;
                    exe()
                });
            }

            prev.addEventListener("click", function () {
                index--;
                exe()
            })

            next.addEventListener("click", function () {
                index++;
                exe()
            })

            window.addEventListener("resize", function () {
                exe()
            });

            // starter
            exe()
        }
    }

    carousel_fade() {
        // check
        if (!document.querySelector(".js-carousel-fade")) {
            return;
        }

        // html
        const carousels = document.querySelectorAll(".js-carousel-fade");
        const btn_class = "bg-primary";

        // loop
        for (let i = 0; i < carousels.length; i++) {
            //html
            const carousel = carousels[i];
            const items = carousel.querySelectorAll(".js-item");
            const paginations = carousel.querySelectorAll(".js-pagination-btn");
            const next = carousel.querySelector(".js-next");
            const prev = carousel.querySelector(".js-prev");

            // vars
            let index = 0;
            const limit = items.length - 1;
            const animation_delay = 500;

            // functions

            function fade_in() {
                // fix index
                index = index == -1 ? limit : (index == limit + 1 ? 0 : index);

                // fade in
                for (let i = 0; i < items.length; i++) {
                    const item = items[i];
                    if (index == i) {
                        item.classList.remove("d-none");
                        item.classList.add("a-fade-in");
                    }
                    else {
                        item.classList.remove("a-fade-in", "a-fade-out");
                        item.classList.add("d-none");
                    }
                }

                // check pagination
                check_pagination();
            }

            function calculate_dimensions() {
                const carousel_width = carousel.clientWidth;
                const carousel_height = carousel.clientHeight;
                for (let i = 0; i < items.length; i++) {
                    const item = items[i];
                    item.style.width = carousel_width + "px";
                    item.style.height = carousel_height + "px";
                }
            }

            function check_pagination() {
                for (let i = 0; i < paginations.length; i++) {
                    const pagination = paginations[i];
                    if (index == i) {
                        pagination.classList.add(btn_class);

                    } else {
                        pagination.classList.remove(btn_class);
                    }
                }
            }

            // events
            for (let i = 0; i < paginations.length; i++) {
                const pagination = paginations[i];
                pagination.addEventListener("click", function () {
                    // html
                    let item = items[index];
                    // fade out
                    item.classList.add("a-fade-out");
                    index = i;

                    setTimeout(() => {
                        fade_in();
                    }, animation_delay);
                });
            }

            prev.addEventListener("click", function () {
                // html
                let item = items[index];
                // fade out
                item.classList.add("a-fade-out");
                index--;

                setTimeout(() => {
                    fade_in();
                }, animation_delay);
            })

            next.addEventListener("click", function () {
                // html
                let item = items[index];
                // fade out
                item.classList.add("a-fade-out");
                index++;

                setTimeout(() => {
                    fade_in();
                }, animation_delay);
            })

            window.addEventListener("resize", function () {
                calculate_dimensions();
            });

            // starter
            calculate_dimensions();
        }
    }

    carousel() {
        // check
        if (!document.querySelector(".js-carousel")) {
            return;
        }

        // html
        const carousels = document.querySelectorAll(".js-carousel");

        // vars
        const class_inactive = "o-3";
        const class_animation = "a-ease-out-fast";

        //loop
        for (let i = 0; i < carousels.length; i++) {
            //html
            const carousel = carousels[i];
            const slider_container = carousel.querySelector(".js-slider-container");
            const slider = carousel.querySelector(".js-slider");
            const next = carousel.querySelector(".js-next");
            const prev = carousel.querySelector(".js-prev");

            //vars
            let slider_position = 0;
            let step;
            let slider_container_width;
            let slider_width;
            let slider_position_limit;
            let is_down;
            let start;


            //functions
            function calculate_sizes() {
                slider_container_width = slider_container.clientWidth;
                slider_width = slider.clientWidth;
                slider_position_limit = slider_width - slider_container_width;
                step = slider_container_width * 0.5;
            }

            function exe() {
                // calculate sizes
                calculate_sizes();

                // scroll
                slider.style.transform = "translateX(-" + slider_position + "px)";

                // check btns
                if (slider_position == 0) {
                    prev.classList.add(class_inactive);
                    next.classList.remove(class_inactive);
                } else if (slider_position == slider_position_limit) {
                    next.classList.add(class_inactive);
                    prev.classList.remove(class_inactive);
                } else {
                    next.classList.remove(class_inactive);
                    prev.classList.remove(class_inactive);
                }
            }

            // window events
            window.addEventListener("resize", function () {
                slider_position = 0;
                exe();
            });

            // btn events
            next.addEventListener("click", function () {
                // get new slider position
                slider_position =
                    slider_position + step > slider_position_limit
                        ? slider_position_limit
                        : slider_position + step;

                // scroll
                exe();
            });
            prev.addEventListener("click", function () {
                // get new slider position
                slider_position =
                    slider_position - step < 0 ? 0 : slider_position - step;

                // scroll
                exe();
            });

            //mouse events
            slider_container.addEventListener("mousedown", function (e) {
                is_down = true;
                slider.classList.remove(class_animation);
                slider.classList.add("a-hand");
                start = e.clientX;
            });

            window.addEventListener("mouseup", function (e) {
                is_down = false;
                slider.classList.add(class_animation);
                slider.classList.remove("a-hand");
            });

            window.addEventListener("mousemove", function (e) {
                // check
                if (!is_down) {
                    return;
                }

                console.log("still down");
                // get new slider position
                slider_position -= (e.clientX - start) / 10;
                slider_position = slider_position < 0 ? 0 : slider_position;
                slider_position = slider_position > slider_position_limit ? slider_position_limit : slider_position;

                // scroll
                exe();

            });


            //starter
            exe();

            // check btns
            if (slider_width <= slider_container_width) {
                next.classList.add("d-none");
                prev.classList.add("d-none");
                slider.classList.add("d-center");
            }


        }

    }

    zoom() {
        // check
        if (!document.querySelector(".js-zoom")) {
            return;
        }

        // html
        const zoom_btns = document.querySelectorAll(".js-zoom");

        // loop
        for (let i = 0; i < zoom_btns.length; i++) {
            // html
            const zoom_btn = zoom_btns[i];
            const box = document.querySelector(".js-zoom-box");
            const img = box.querySelector("img");
            const close = box.querySelector(".js-close");

            // events
            zoom_btn.addEventListener("click", function () {
                // transfer image src
                img.src = zoom_btn.style.backgroundImage.slice(5, -2);

                // open box
                box.classList.remove("d-none");
                setTimeout(() => {
                    box.classList.remove("o-invisible");
                }, 100);
            })

            close.addEventListener("click", function () {
                box.classList.add("o-invisible");
                setTimeout(() => {
                    box.classList.add("d-none");
                }, 500);
            })
        }

    }

    links() {
        // check
        if (!document.querySelector(".js-link")) {
            return;
        }

        // html
        const links = document.querySelectorAll(".js-link");

        // vars
        const class_active = "";

        // exe
        for (let i = 0; i < links.length; i++) {
            // html
            const link = links[i];

            // vars
            const url = window.location.href;
            const link_href = link.href;

            // exe
            if (url.includes(link_href)) {
                link.classList.add(class_active);
            }
            else {
                link.classList.remove(class_active);
            }
        }

    }

    fade_out() {
        // check
        if (!document.querySelector(".js-fade-out")) {
            return;
        }

        // html
        const items = document.querySelectorAll(".js-fade-out");

        // vars
        const delay = 2000;

        // loop
        for (let i = 0; i < items.length; i++) {
            // html
            const item = items[i];

            // exe
            setTimeout(() => {
                item.classList.add("a-fade-out");
                setTimeout(() => {
                    item.classList.add("d-none");
                }, 500);
            }, delay);
        }

    }


    submit() {
        // check
        if (!document.querySelector(".js-submit")) {
            return;
        }

        // html
        const btns = document.querySelectorAll(".js-submit");

        // loop
        for (let i = 0; i < btns.length; i++) {
            // vars
            const btn = btns[i];
            const form_id = btn.dataset.form_id;
            const form = document.getElementById(form_id);

            // event
            btn.addEventListener("click", function () {
                form.submit();
            })

        }
    }

    format_int() {
        // check
        if (!document.querySelector(".js-format-int")) {
            return;
        }

        // html 
        const ints = document.querySelectorAll(".js-format-int");

        // loop
        for (let i = 0; i < ints.length; i++) {
            // html
            const int = ints[i];

            // var
            const value = parseInt(int.innerHTML);
            let result;

            // format
            if (value >= 1000000) {
                result = Math.floor(value / 1000000) + "M";
            }
            else if (value >= 10000) {
                result = Math.floor(value / 1000) + "K";
            }
            else {
                result = value;
            }

            // exe
            int.innerHTML = result;
        }


    }
}