export const activityFormSchema = [
    {
        name: "assigned_to_user_id",
        label: "Assigned To",
        type: "select",
        props: {
            options: [],
        },
    },
    {
        name: "subject",
        label: "Subject",
        type: "text",
        props: {
            placeholder: "Enter activity subject",
        },
    },
    {
        name: "type",
        label: "Activity Type",
        type: "select",
        props: {
            options: [
                { label: "Call", value: "call" },
                { label: "Meeting", value: "meeting" },
                { label: "Email", value: "email" },
                { label: "Task", value: "task" },
            ],
        },
    },
    {
        name: "status",
        label: "Status",
        type: "select",
        props: {
            options: [
                { label: "Planned", value: "planned" },
                { label: "Completed", value: "completed" },
                { label: "Cancelled", value: "cancelled" },
            ],
        },
    },
    {
        name: "scheduled_at",
        label: "Scheduled At",
        type: "datetime",
    },
    {
        name: "duration_minutes",
        label: "Duration (minutes)",
        type: "number",
        props: {
            min: 0,
        },
    },
    {
        name: "description",
        label: "Description",
        type: "textarea",
        props: {
            rows: 3,
        },
    },
];
