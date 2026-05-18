<?php

namespace App\Services;

use App\Models\EventCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use InvalidArgumentException;

class EventCategoryService
{
    /**
     * Get a paginated list of categories with filters, search, and sorting.
     */
    public function getPaginatedCategories(array $filters): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $status = $filters['status'] ?? null;
        $sort = $filters['sort'] ?? 'created_at';
        $order = $filters['order'] ?? 'desc';
        $isDeletedFilter = $status === 'deleted';

        return EventCategory::query()
            ->when($isDeletedFilter, function ($query) {
                return $query->onlyTrashed();
            })
            ->when(! $isDeletedFilter && $search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when(in_array($sort, ['name', 'created_at']), function ($query) use ($sort, $order) {
                return $query->orderBy($sort, $order === 'asc' ? 'asc' : 'desc');
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Create a new category.
     */
    public function createCategory(array $data): EventCategory
    {
        $data['slug'] = Str::slug($data['name']);

        return EventCategory::create($data);
    }

    /**
     * Update an existing category.
     */
    public function updateCategory(EventCategory $category, array $data): EventCategory
    {
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return $category;
    }

    /**
     * Delete a category if it has no associated events.
     */
    public function deleteCategory(EventCategory $category): void
    {
        if ($category->events()->exists()) {
            throw new InvalidArgumentException('Cannot archive category because it is currently assigned to one or more events.');
        }

        $category->delete();
    }
}
