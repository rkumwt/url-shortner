<template>
    <a-page-header style="padding: 25px 0px" title="Clients">
        <template #extra>
            <a-button type="primary">Invite</a-button>
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
            <template v-if="column.dataIndex === 'created_at'">
                {{ dayjs(record.created_at).format("DD MMM YYYY") }}
            </template>
        </template>
    </a-table>
</template>

<script setup>
import { ref, onMounted } from "vue";
import dayjs from "dayjs";
import fields from "./fields";
import datatable from "@/composable/datatable";

const { columns } = fields();
const { url, data, tablePagination, fetchData, handleTableChange } = datatable();

onMounted(() => {
    url.value = "superadmin/urls";
    fetchData();
});
</script>
