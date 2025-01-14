<script setup>
import {router, useForm, usePage} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import debounce from "lodash.debounce";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    endpoint: Object
})
const page = usePage()
const editForm = useForm({
    location: props.endpoint.location,
    frequency: props.endpoint.frequency_value
})

const editEndpoint = debounce(() => {
    editForm.patch(`/endpoints/${props.endpoint.id}`, {
        preserveScroll: true
    })
}, 500)

watch(() => editForm.isDirty, () => {
    editEndpoint()
})

const editing = ref(false)
const deleteEndpoint = () => {
    if (window.confirm('You sure?')) {
        router.delete(`/endpoints/${props.endpoint.id}`)
    }
}
</script>

<template>
    <tr>
        <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">
            <template v-if="editing">
                <InputLabel for="location" value="Location" class="sr-only"/>
                <TextInput v-model="editForm.location" id="location" type="text" class="block w-full h-9 text-sm"
                           placeholder="e.g pricing/"/>
            </template>
            <template v-else>
                <a href="/" class="text-indigo-600 hover:text-indigo-900">
                    {{ endpoint.location }}
                </a>
            </template>
        </td>
        <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
            <template v-if="editing">
                <InputLabel for="frequency" value="Frequency" class="sr-only"/>
                <select v-model="editForm.frequency" name="frequency" id="frequency"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm">
                    <option :value="frequency.frequency" v-for="frequency in page.props.endpointFrequencies.data"
                            :key="frequency.frequency">
                        {{ frequency.label }}
                    </option>
                </select>
            </template>
            <template v-else>{{ endpoint.frequency_label }}</template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            Last check
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            Status
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            x%
        </td>
        <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32">
            <button v-on:click="editing=!editing" class="text-indigo-600 hover:text-indigo-900">
                {{ editing ? 'Done' : 'Edit' }}
            </button>
        </td>
        <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16">
            <button v-on:click="deleteEndpoint" class="text-red-600 hover:text-red-900">
                Delete
            </button>
        </td>
    </tr>
</template>
