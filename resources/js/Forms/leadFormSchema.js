export const leadFormSchema = [
    {
        name: "company_name",
        label: "Company Name",
        type: "text",
        props: {
            placeholder: "Enter company name",
        },
    },
    {
        name: "first_name",
        label: "First Name",
        type: "text",
        props: {
            placeholder: "Enter first name",
        },
    },
    {
        name: "last_name",
        label: "Last Name",
        type: "text",
        props: {
            placeholder: "Enter last name",
        },
    },
    {
        name: "lead_number",
        label: "Lead Number",
        type: "text",
        props: {
            placeholder: "Auto / Manual",
            disabled: true,
        },
    },
    {
        name: "status",
        label: "Status",
        type: "select",
        props: {
            options: [
                { label: "New", value: "new" },
                { label: "Contacted", value: "contacted" },
                { label: "Qualified", value: "qualified" },
                { label: "Converted", value: "converted" },
                { label: "Lost", value: "lost" },
            ],
        },
    },
    {
        name: "source",
        label: "Source",
        type: "select",
        props: {
            options: [
                { label: "Website", value: "website" },
                { label: "Referral", value: "referral" },
                { label: "Campaign", value: "campaign" },
                { label: "Other", value: "other" },
            ],
        },
    },
    {
        name: "email",
        label: "Email",
        type: "email",
        props: {
            placeholder: "example@email.com",
        },
    },
    {
        name: "mobile",
        label: "Mobile",
        type: "text",
        props: {
            placeholder: "Enter mobile number",
        },
    },
    {
        name: "assigned_to_user_id",
        label: "Assigned To",
        type: "select",
        props: {
            options: [],
            placeholder: "Select user",
        },
    },

    {
        name: "opportunity_name",
        label: "Opportunity Name",
        type: "text",
        props: {
            placeholder: "Opportunity name",
        },
    },
    {
        name: "industry",
        label: "Industry",
        type: "select",
        props: {
            options: [
                { label: "Apparel", value: "apparel" },
                { label: "IT", value: "it" },
                { label: "Manufacturing", value: "manufacturing" },
                { label: "Other", value: "other" },
            ],
        },
    },
    {
        name: "product_category",
        label: "Product Category",
        type: "text",
        props: {
            placeholder: "Product category",
        },
    },
    {
        name: "department",
        label: "Department",
        type: "text",
        props: {
            placeholder: "Department",
        },
    },
    {
        name: "designation",
        label: "Designation",
        type: "text",
        props: {
            placeholder: "Designation",
        },
    },
    {
        name: "lead_cost",
        label: "Lead Cost",
        type: "number",
        props: {
            min: 0,
        },
    },
    {
        name: "total_lead_cost",
        label: "Total Lead Cost",
        type: "number",
        props: {
            min: 0,
        },
    },
    {
        name: "currency",
        label: "Currency",
        type: "select",
        props: {
            options: [
                { label: "INR", value: "INR" },
                { label: "USD", value: "USD" },
                { label: "EUR", value: "EUR" },
            ],
        },
    },
    {
        name: "percentage",
        label: "Percentage",
        type: "number",
        props: {
            min: 0,
            max: 100,
        },
    },
    {
        name: "follow_up_at",
        label: "Follow-up Date & Time",
        type: "datetime",
        props: {},
    },
    {
        name: "follow_up_type",
        label: "Follow-up Type",
        type: "select",
        props: {
            options: [
                { label: "Call", value: "call" },
                { label: "Meeting", value: "meeting" },
                { label: "Email", value: "email" },
            ],
        },
    },
    {
        name: "closed_date",
        label: "Closed Date",
        type: "date",
        props: {},
    },
    {
        name: "website",
        label: "Website",
        type: "url",
        props: {
            placeholder: "https://www.example.com",
        },
    },
    {
        name: "city",
        label: "City",
        type: "text",
        props: {
            placeholder: "City name",
        },
    },
    {
        name: "address",
        label: "Address",
        type: "textarea",
        props: {
            rows: 3,
            placeholder: "Full address",
            class: "col-span-2 col-start-1",
        },
    },
    {
        name: "notes",
        label: "Notes",
        type: "textarea",
        props: {
            rows: 4,
            placeholder: "Add notes here...",
            class: "col-span-2 col-start-3",
        },
    },
];
