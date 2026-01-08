export const userFormSchema = [
    {
        name: "name",
        label: "Full Name",
        type: "text",
        props: {
            placeholder: "Enter full name",
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
        name: "password",
        label: "Password",
        type: "password",
        props: {
            placeholder: "Set initial password",
        },
    },
    {
        name: "password_confirmation",
        label: "Confirm Password",
        type: "password",
        props: {
            placeholder: "Confirm password",
        },
    },
    {
        name: "phone",
        label: "Phone",
        type: "text",
        props: {
            placeholder: "Enter phone number",
        },
    },
    {
        name: "date_of_birth",
        label: "Date of Birth",
        type: "date",
        props: {},
    },
    {
        name: "gender",
        label: "Gender",
        type: "select",
        props: {
            options: [
                { label: "Male", value: "male" },
                { label: "Female", value: "female" },
                { label: "Other", value: "other" },
            ],
        },
    },
    {
        name: "role",
        label: "Role",
        type: "select",
        props: {
            options: [
                { label: "User", value: "user" },
                { label: "Admin", value: "admin" },
                { label: "Sales", value: "sales" },
            ],
        },
    },
    {
        name: "is_active",
        label: "Active",
        type: "checkbox",
        props: {},
    },
    {
        name: "profile_image",
        label: "Profile Image",
        type: "file",
        props: {
            accept: "image/*",
        },
    },
    {
        name: "bio",
        label: "Bio",
        type: "textarea",
        props: {
            rows: 3,
            placeholder: "Short bio",
            class: "col-span-2",
        },
    },
];
