<template>
    <a-page-header style="padding: 25px 0px" title="Clients">
        <template #extra>
            <Invite />
        </template>
    </a-page-header>

    <a-table
        :columns="columns"
        :data-source="data"
        :pagination="tablePagination"
        @change="handleTableChange"
        size="middle"
    >
        <template #bodyCell="{ column, record }">
            <template v-if="column.dataIndex === 'name'">
                <a-button
                    type="link"
                    @click="
                        () => {
                            $router.push({
                                name: 'superadmin.urls.client',
                                params: { client_id: record.id },
                            });
                        }
                    "
                    style="padding: 0"
                >
                    {{ record.name }}
                </a-button>
                <br />
                {{ record.email }}
            </template>
        </template>
    </a-table>
</template>

<script setup>
import { ref, onMounted } from "vue";
import fields from "@/views/superadmin/clients/fields";
import datatable from "@/composable/datatable";
import Invite from "./Invite.vue";

const { columns } = fields();
const { url, data, tablePagination, fetchData, handleTableChange } = datatable();

onMounted(() => {
    url.value = "superadmin/clients";
    fetchData();
});
</script>
