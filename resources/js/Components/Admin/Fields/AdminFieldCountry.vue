<template>
    <q-select v-model="model" label="Country" dense
              :options="options"
              map-options
              emit-value
              @filter="filterFn"
              use-input
              input-debounce="0"
              autocomplete="off"
              @blur="$emit('blur')"
              :error="error"
              :square="square"
              :filled="filled"
              :outlined="outlined"

    >
                <template v-slot:error>
                    <div v-for="(item,k) in errors">{{ item.$message }}</div>
                </template>
    </q-select>
</template>

<script>
import axios from 'axios';

export default {
    name: "AdminFieldCountry",
    emits: ['update:modelValue'],
    props: {
        modelValue: {
            type: String,
            default: null
        },
        error: {
            type: Boolean,
            default: false
        },
        errors: {
            type: Array,
            default: ()=>[]
        },
        square: false,
        filled: false,
        outlined: false,
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
    },

    created() {
        axios.get(route('config.getCountries')).then(res => {
            res.data.forEach(v => {
                this.items.push({
                    label: v.country,
                    value: v.country,
                });
                this.options.push({
                    label: v.country,
                    value: v.country,
                })
            });
        })
        this.model = this.modelValue;
    },

    mounted() {
        this.model = this.modelValue;
    }


}
</script>

<style scoped>

</style>
