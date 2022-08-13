<template>
    <q-select v-model="model" label="Roles" dense square filled
              :options="options"
              map-options
              emit-value
              autocomplete="off"
              @blur="$emit('blur')"
              :error="error"
              multiple
              use-chips
    >
        <template v-slot:error>
            <div v-for="(item,k) in errors">{{ item.$message }}</div>
        </template>
    </q-select>
</template>

<script>
import axios from 'axios';
export default {
    name: "AdminFieldRoles",
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
    },

    methods: {
        getRoles(){
            this.options = [];
            this.items = [];
            axios.get(route('dashboard.getRoles')).then(res => {
                res.data.forEach(v => {
                    this.options.push({
                        label: v.name,
                        value: v.id,
                    })
                });
            })
        }
    },

    created() {
        this.getRoles();
        this.model = this.modelValue;
    },

    mounted() {
        this.model = this.modelValue;
    }
}
</script>

<style scoped>

</style>
