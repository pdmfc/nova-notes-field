<template>
    <!--    <span>{{ field.value }} Opa</span>-->
    <a href="#"
       class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltip"
       data-testid="users-items-0-view-button" dusk="1-view-button" data-original-title="null">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-current">
            <path
                d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2zM20 5H4v10h13a1 1 0 0 1 .7.3l2.3 2.29V5z"/>
        </svg>
        <div class="px-2 py-1 text-sm rounded-full no-underline text-white bg-primary">1</div>
    </a>
</template>

<script>
export default {
    props: ['resourceName', 'field']
}
</script>
