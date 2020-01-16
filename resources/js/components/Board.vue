<template>
    <div class="col-sm-6 col-md-4 col-xl">
        <div class="c-board c-board--info">
            <div class="c-board__header">
                <h4 class="c-board__title">
                    {{ board.title }}
                    <span class="u-text-mute"> 8</span>
                </h4>

                <div class="c-board__actions dropdown">
                    <a
                        class="dropdown-toggle"
                        href="#"
                        id="dropdwonMenuBoard1"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        ><i class="fa fa-ellipsis-h"></i
                    ></a>
                    <div
                        class="c-dropdown__menu dropdown-menu dropdown-menu-right"
                        aria-labelledby="dropdwonMenuBoard1"
                    >
                        <a href="#" class="c-dropdown__item">Action 1</a>
                        <a href="#" class="c-dropdown__item">Action 2</a>
                        <a href="#" class="c-dropdown__item">Action 3</a>
                    </div>
                </div>
            </div>

            <div class="c-board__content">
                <!-- // .c-task -->
                <task></task>
            </div>
            <a href="#" class="c-board__btn">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <!-- // .c-board__content -->
    </div>
    <!-- // .c-board -->
</template>

<script>
import Task from "./Task.vue";

export default {
    props: ["board"],
    components: { Task },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
