# SOLID.md

## Unit Tests: Why I used 'ShippingContext' instead of 'Order'

The calculators accept a `ShippingContext` object instead of the Eloquent `Order` model. `ShippingContext` is a small, readonly class with two fields (`weightGrams`, `country`) just the data each calculator actually needs.

**Open/Closed Principle (OCP)**
If a future shipping method needs a new factor beyond `weightGrams` and `country`, that field is added directly to `ShippingContext`. Existing calculators don't need to change, they simply continue to ignore fields they don't use, the same way
`FlatRateShippingCalculator` already ignores both existing fields.

**Interface Segregation Principle (ISP)**
The calculator classes only need two fields to calculate a shipping cost. There's no need to expose them to the full `Order` model with all its unrelated fields (`customer_name`, `subtotal_minor`, `status`, etc.), and no need to depend on the database to construct one in a test.

**Dependency Inversion Principle (DIP)**
High-level modules (the calculators, which hold the business logic) shouldn't depend directly on low-level modules `Order`
`ShippingContext` is a plain, database-free data object instead of the model.

