export function formatDate(value) {
    if (!value) return "-";

    const date = new Date(value);

    return date.toLocaleDateString("en-IN", {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}

export function formatTime(value) {
    if (!value) return "-";

    const date = new Date(`1970-01-01T${value}`);

    return date.toLocaleTimeString("en-IN", {
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    });
}

export function formatDateTime(value) {
    if (!value) return "-";

    const date = new Date(value);

    return date.toLocaleString("en-IN", {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    });
}

export const formatDateForInput = (value) => {
    if (!value) return "";
    return value.split("T")[0];
};

export const formatDateTimeForInput = (value) => {
    if (!value) return "";
    return value.replace(" ", "T").slice(0, 16);
};
