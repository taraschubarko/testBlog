<template>
    <q-select v-model="model" label="City" dense square filled
              :options="options"
              map-options
              emit-value
              @filter="filterFn"
              use-input
              input-debounce="0"
              autocomplete="off"
              @blur="$emit('blur')"
              :error="error"
    >
                <template v-slot:error>
                    <div v-for="(item,k) in errors">{{ item.$message }}</div>
                </template>
    </q-select>
</template>

<script>
import axios from 'axios';
export default {
    name: "AdminFieldCity",

    emits: ['update:modelValue'],
    props: {
        modelValue: {
            type: String,
            default: null
        },
        country:{String},
        error: {
            type: Boolean,
            default: false
        },
        errors: {
            type: Array,
            default: ()=>[]
        },
    },
    data() {
        return {
            model: null,
            items: [],
            options: []
        }
    },

    watch: {
        model(newValue, oldValue) {
            this.$emit('update:modelValue', newValue);
        },
        modelValue(newValue) {
            this.model = newValue;
        },
        country(newValue){
            this.getCities(newValue);
        }
    },

    methods: {
        filterFn(val, update) {
            if (val === '') {
                update(() => {
                    this.options = this.items
                })
                return
            }
            update(() => {
                const needle = val.toLowerCase()
                this.options = this.items.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
            })
        },
        getCities(val){
            this.options = [];
            this.items = [];
            axios.get(route('dashboard.getCities', {country: val || 'link'})).then(res => {
                res.data.forEach(v => {
                    this.items.push({
                        label: v.city,
                        value: v.city,
                    });
                    this.options.push({
                        label: v.city,
                        value: v.city,
                    })
                });
            })
        }
    },

    created() {
        this.model = this.modelValue;
        this.getCities(this.country);
    },

    mounted() {
        this.model = this.modelValue;
    }
}
</script>

<style scoped>

</style>
