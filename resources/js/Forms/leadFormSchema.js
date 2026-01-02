export const leadFormSchema = [
    {
        name: "name",
        label: "Name",
        type: "text",
        required: true,
    },
    {
        name: "email",
        label: "Email",
        type: "email",
    },
    {
        name: "phone",
        label: "Phone",
        type: "text",
    },
    {
        name: "status",
        label: "Status",
        type: "select",
        options: [
            { label: "New", value: "new" },
            { label: "Contacted", value: "contacted" },
            { label: "Qualified", value: "qualified" },
            { label: "Converted", value: "converted" },
            { label: "Lost", value: "lost" },
        ],
        required: true,
    },
    {
        name: "source",
        label: "Source",
        type: "select",
        options: [
            { label: "Website", value: "website" },
            { label: "Referral", value: "referral" },
            { label: "Cold Call", value: "cold-call" },
            { label: "Ads", value: "ads" },
        ],
    },
    {
        name: "tags",
        label: "Tags",
        type: "multiselect",
        options: [
            { label: "Hot", value: "hot" },
            { label: "Enterprise", value: "enterprise" },
            { label: "Follow-up", value: "follow-up" },
        ],
    },
    {
        name: "follow_up_date",
        label: "Follow-up Date",
        type: "date",
    },
    {
        name: "follow_up_time",
        label: "Follow-up Time",
        type: "time",
    },
    {
        name: "meeting_at",
        label: "Meeting At",
        type: "datetime",
    },
    {
        name: "is_active",
        label: "Active",
        type: "checkbox",
    },
    {
        name: "notes",
        label: "Notes",
        type: "textarea",
        fullWidth: true,
    },
];
