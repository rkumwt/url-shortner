<template>
    <a-page-header style="padding: 25px 0px" title="Clients">
        <template #extra>
            <a-button type="primary">Invite</a-button>
        </template>
    </a-page-header>

    <a-table :columns="columns" :data-source="data"> </a-table>
</template>

<script setup>
const columns = [
    {
        name: "Client name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Users",
        dataIndex: "age",
        key: "age",
    },
    {
        title: "Total Generated URLs",
        dataIndex: "address",
        key: "address",
    },
    {
        title: "Total URL Hits",
        key: "tags",
        dataIndex: "tags",
    },
];

const data = [];
</script>
