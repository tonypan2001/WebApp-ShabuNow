<template>
    <div class="flex flex-col justify-center items-center w-full mb-10">
        <h1 class="bg-black text-center text-white text-xl rounded-t-xl py-2 px-4">
            <slot name="title">
                Default Title
            </slot>
        </h1>
        <table class="text-center text-sm lg:text-lg rounded-xl table-auto w-full border-2 border-slate-400 border-separate border-spacing-3">
            <thead>
                <tr>
                    <th v-for="data in datas" class="border border-slate-300 rounded-xl p-2 bg-gray-100">
                        {{ data.title }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td v-for="data in datas" class="border border-slate-300 rounded-xl p-2">
                        {{ data.info }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['datas','title']
}
</script>