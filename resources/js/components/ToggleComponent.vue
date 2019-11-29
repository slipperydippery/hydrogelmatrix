<template>
    <div class="mt-6">
        <label class="switch">
            <input type="checkbox"
                   class="form-checkbox"
                   :aria-checked="value.toString()"
                   @click="toggle"
            >
            <span class="slider round"></span>
        </label>
        <span class="ml-2 text-gray-400" :class="{ 'text-teal-700 font-semibold': value }" v-if="label"> {{ labelText }} </span>
    </div>
</template>

<script>
    export default {
        name: "ToggleComponent",

        props: [
            'value',
            'label',
            'falselabel'
        ],

        computed: {
            labelText() {
                var text = this.label
                if(!this.value && this.falselabel){
                    text = this.falselabel
                }
                return text
            }
        },

        methods: {
            toggle(){
                this.$emit('input', !this.value)
            }
        }
    }
</script>
