<template>
    <div id="link">
        <div class="welcome" id="banner">
            <div class="text-center">
                <h1>URLs Shortner</h1>
                <p>Smart URLs Shortner Short your URL easily</p>
                <urlshort-component></urlshort-component>
            </div>
        </div>

        <!--Animation style-->
        <div class="circle">
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <footer-component></footer-component>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
