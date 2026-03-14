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
            <template v-if="column.dataIndex === 'role'">
                {{ record.type === "admin" ? "Admin" : "Member" }}
            </template>
        </template>
    </a-table>
</template>

<script setup>
import { ref, onMounted } from "vue";
import fields from "./fields";
import datatable from "@/composable/datatable";
import Invite from "./Invite.vue";

const { columns } = fields();
const { url, data, tablePagination, fetchData, handleTableChange } = datatable();

onMounted(() => {
    url.value = "admin/team-members";
    fetchData();
});
</script>
