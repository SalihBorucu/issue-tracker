<template>
    <li class="c-stream-item o-media">
        <div class="o-media__img u-mr-small">
            <div class="c-avatar c-avatar--medium">
                <img
                    class="c-avatar__img"
                    src="img/avatar3-120.jpg"
                    alt="Adam's face"
                />
            </div>
        </div>

        <div class="c-stream-item__content o-media__body">
            <div class="c-stream-item__header">
                <a class="c-stream-item__name">{{ comment.user.name }} </a>
                <span class="c-stream-item__time">
                    {{ comment.human_readable_date }}
                </span>
            </div>

            <p class="u-mb-small">
                {{ comment.message }}
            </p>
        </div>
    </li>
</template>

<script>
export default {
    props: ["comment"]
};
</script>
