const fields = () => {
    const columns = [
        {
            title: "Short URL",
            dataIndex: "short_url_code",
        },
        {
            title: "Long URL",
            dataIndex: "url",
        },
        {
            title: "Hits",
            dataIndex: "hits",
        },
        {
            title: "Client",
            dataIndex: "client",
        },
        {
            title: "Created On",
            dataIndex: "created_at",
        },
    ];

    return {
        columns
    }
}


export default fields;
