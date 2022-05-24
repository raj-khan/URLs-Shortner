<template>
    <div id="link">
        <div class="welcome" id="banner">
            <div class="text-center">
                <h1>URl Shortner</h1>
                <p>Smart URL Shortner Short your URL smartly</p>
                <urlshort-component></urlshort-component>
            </div>
        </div>

        <div class="square">
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
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
